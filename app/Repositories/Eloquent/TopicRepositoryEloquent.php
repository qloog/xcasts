<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Models\Vote;
use Auth;
use Parsedown;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\TopicRepository;
use App\Models\Topic;

/**
 * Class TopicRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class TopicRepositoryEloquent extends BaseRepository implements TopicRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Topic::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function create(array $attributes)
    {
        // 检查是否冲突添加
        if ($this->isDuplicate($attributes)) {
            throw new \RuntimeException('相同topic已经存在');
        }

        if (isset($attributes['body'])) {
            $attributes['origin_body'] = $attributes['body'];
            $attributes['body'] = (new Parsedown())->setBreaksEnabled(true)->text($attributes['body']);
        }

        $attributes['user_id'] = Auth::id();
        $attributes['source'] = 'PC';

        $topic = parent::create($attributes); // TODO: Change the autogenerated stub
        if (!$topic) {
            throw new \RuntimeException('创建topic失败');
        }

        Auth::user()->increment('topic_count', 1);

        return $topic;
    }

    public function update(array $attributes, $id)
    {
        if (isset($attributes['body'])) {
            $attributes['origin_body'] = $attributes['body'];
            $attributes['body'] = (new Parsedown())->setBreaksEnabled(true)->text($attributes['body']);
        }

        $result = parent::update($attributes, $id);
        if (!$result) {
            throw new \RuntimeException('更新topic失败');
        }

        return $result;
    }

    /**
     * @param array $data
     * @return bool
     */
    public function isDuplicate(array $data)
    {
        $lastTopic = Topic::where('user_id', Auth::id())
            ->orderBy('id', 'desc')
            ->first();
        return $lastTopic instanceof Topic && strcmp($lastTopic->title, $data['title']) === 0;
    }

    /**
     * @param $id
     * @param $field
     * @return mixed
     */
    public function increment($id, $field)
    {
        return Topic::where('id', $id)->increment($field);
    }

    public function voteBy($id)
    {
        $user_ids = Vote::where('votable_type', Topic::class)
            ->where('votable_id', $id)
            ->where('is', 'upvote')
            ->pluck('user_id')
            ->toArray();
        return User::whereIn('id', $user_ids)->get();
    }
}

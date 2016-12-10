<?php

namespace App\Repositories\Eloquent;

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
        if (isset($attributes['body'])) {
            $attributes['origin_body'] = $attributes['body'];
            $attributes['body'] = (new Parsedown())->setBreaksEnabled(true)->text($attributes['body']);
        }

        $attributes['user_id'] = Auth::id();
        $attributes['last_reply_user_id'] = Auth::id();

        return parent::create($attributes); // TODO: Change the autogenerated stub
    }
}

<?php

namespace App\Repositories\Eloquent;

use App\Models\Video;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\VideoRepository;
use App\Validators\VideoValidator;

/**
 * Class VideoRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class VideoRepositoryEloquent extends BaseRepository implements VideoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Video::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getVideoListByCourseId($courseId)
    {
        return $this->scopeQuery(function($query) use ($courseId) {
            return $query->where('course_id', $courseId)
                ->orderBy('course_id', 'desc')
                ->orderBy('episode_id', 'desc');
        })->paginate(10);
    }

}

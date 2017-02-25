<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\SeriesRepository;
use App\Models\Series;
use App\Validators\CourseValidator;

/**
 * Class CourseRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class SeriesRepositoryEloquent extends BaseRepository implements SeriesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Series::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function getCourseListByType($type = null, $limit = 10)
    {
        if ($type) {
            return $this->model->type($type)->orderBy('id','desc')->paginate($limit);
        }
        return $this->model->orderBy('id','desc')->paginate($limit);
    }
}

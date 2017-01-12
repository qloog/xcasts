<?php

namespace App\Repositories\Eloquent;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\CourseRepository;
use App\Models\Course;
use App\Validators\CourseValidator;

/**
 * Class CourseRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class CourseRepositoryEloquent extends BaseRepository implements CourseRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Course::class;
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
            return $this->model->type($type)->paginate($limit);
        }
        return $this->model->paginate($limit);
    }
}

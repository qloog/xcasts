<?php

namespace App\Repositories\Eloquent;

use App\Models\Lesson;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\LessonRepository;
use App\Validators\VideoValidator;

/**
 * Class LessonRepositoryEloquent
 * @package namespace App\Repositories\Eloquent;
 */
class LessonRepositoryEloquent extends BaseRepository implements LessonRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Lesson::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

}

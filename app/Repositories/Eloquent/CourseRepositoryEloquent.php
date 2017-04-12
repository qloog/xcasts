<?php

namespace App\Repositories\Eloquent;

use App\Services\QiNiuService;
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
            $list = $this->model->type($type)->orderBy('id','desc')->paginate($limit);
            return $this->handleCoverImage($list);
        }
        $list = $this->model->orderBy('id','desc')->paginate($limit);
        return $this->handleCoverImage($list);
    }

    private function handleCoverImage($data)
    {
        if (!$data) {
            return $data;
        }

        $qiNiuSrv = new QiNiuService();
        foreach ($data as &$item) {
            $item->cover_image = $qiNiuSrv->fileUrlWithToken($item->cover_image);
        }

    }
}

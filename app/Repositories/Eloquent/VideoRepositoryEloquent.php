<?php

namespace App\Repositories\Eloquent;

use App\Services\QiNiuService;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Contracts\Repositories\VideoRepository;
use App\Models\Video;
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
}

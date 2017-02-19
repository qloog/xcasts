<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface SeriesRepository
 * @package namespace App\Contracts\Repositories;
 */
interface SeriesRepository extends RepositoryInterface
{
    public function getCourseListByType($type, $limit);
}

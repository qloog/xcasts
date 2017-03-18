<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface CourseRepository
 * @package namespace App\Contracts\Repositories;
 */
interface CourseRepository extends RepositoryInterface
{
    public function getCourseListByType($type, $limit);
}

<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace App\Contracts\Repositories\Backend;
 */
interface UserRepository extends RepositoryInterface
{
    public function getMyReplies($userId);

    public function getMyTopics($userId);


}

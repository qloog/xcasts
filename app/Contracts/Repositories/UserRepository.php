<?php

namespace App\Contracts\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository
 * @package namespace App\Contracts\Repositories\Backend;
 */
interface UserRepository extends RepositoryInterface
{
    public function getRepliesByUserId($userId, $limit);

    public function getTopicsByUserId($userId, $limit);

    public function getFollowingByUserId($userId, $limit);

    public function getVotesByUserId($userId, $limit);


}

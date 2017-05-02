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

    public function getVotesByUserId($userId, $limit);

    public function getFollowingsByUserId($userId, $limit);

    public function getFollowersByUserId($userId, $limit);

    public function getUserIdByName($name);

    public function followUser($userId);

    public function openVip($data);


}

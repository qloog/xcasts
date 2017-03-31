<?php

namespace App\Contracts\Repositories;

use App\Models\Comment;
use App\Models\Reply;
use App\Models\Topic;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface VoteRepository
 * @package namespace App\Contracts\Repositories;
 */
interface VoteRepository extends RepositoryInterface
{
    public function topicUpVote(Topic $topic);

    public function topicDownVote(Topic $topic);

    public function replyUpVote(Reply $reply);

    public function commentUpVote(Comment $comment);
}

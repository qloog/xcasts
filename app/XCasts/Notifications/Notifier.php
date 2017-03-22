<?php
/**
 * 通知器
 *
 * @filename: Notifier.php
 * @author  : quanlongwang@gmail.com
 * @date    : 22/03/2017 21:20
 */

namespace XCasts\Notifications;

use App\Models\Notification;
use App\Models\Reply;
use App\Models\Topic;
use App\Models\User;

class Notifier
{

    /**
     * 新回复通知
     *
     * @param User    $fromUser
     * @param Mention $mentionParser
     * @param Topic   $topic
     * @param Reply   $reply
     */
    public function newReplyNotify(User $fromUser, Mention $mentionParser, Topic $topic, Reply $reply)
    {
        // notify the author
        Notification::batchNotify('new_reply', $fromUser, [$topic->user], $topic, $reply);

        // notify attented users
        //Notification::batchNotify('attention', $fromUser, $topic->attentedUsers(), $topic, $reply);

        // notify mentioned users
        Notification::batchNotify('at', $fromUser, $mentionParser->users, $topic, $reply);
    }
}
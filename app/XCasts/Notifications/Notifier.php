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

    public $notifiedUsers = [];

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
        Notification::batchNotify('new_reply', $fromUser, $this->removeDuplication([$topic->user]), $topic, $reply);

        // notify attented users
        //Notification::batchNotify('attention', $fromUser, $topic->attentedUsers(), $topic, $reply);

        // notify mentioned users
        Notification::batchNotify('at', $fromUser, $this->removeDuplication($mentionParser->users), $topic, $reply);
    }

    /**
     * in case of a user get a lot of the same notification
     *
     * @param $users
     * @return array
     */
    public function removeDuplication($users)
    {
        $notYetNotifyUsers = [];
        foreach ($users as $user) {
            if ( ! in_array($user->id, $this->notifiedUsers)) {
                $notYetNotifyUsers[] = $user;
                $this->notifiedUsers[] = $user->id;
            }
        }
        return $notYetNotifyUsers;
    }
}
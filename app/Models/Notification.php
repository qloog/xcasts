<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    // Don't forget to fill this array
    protected $fillable = ['from_user_id', 'user_id', 'topic_id', 'video_id', 'post_id', 'reply_id', 'body', 'type'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function video()
    {
        return $this->belongsTo(Video::class);
    }

    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    // for api
    public function from_user()
    {
        return $this->belongsTo(User::class, 'from_user_id');
    }

    /**
     * Create a notification
     * @param  string  $type     have 'at', 'new_reply', 'attention', 'append'
     * @param  User  $fromUser come from who
     * @param  array $users    to who, array of users
     * @param  Topic $topic    current context
     * @param  Reply $reply    the content
     * @param null   $content
     */
    public static function batchNotify($type, User $fromUser, $users, Topic $topic, Reply $reply = null, $content = null)
    {
        $nowTimestamp = Carbon::now()->toDateTimeString();
        $data = [];
        foreach ($users as $toUser) {
            if ($fromUser->id == $toUser->id) {
                continue;
            }
            $data[] = [
                'from_user_id' => $fromUser->id,
                'user_id' => $toUser->id,
                'topic_id' => $topic->id,
                'reply_id' => $content ?: ($reply ? $reply->id : ''),
                'body' => $content ?: ($reply ? $reply->body : ''),
                'type' => $type,
                'created_at' => $nowTimestamp,
                'updated_at' => $nowTimestamp
            ];
            $toUser->increment('notification_count', 1);
        }
        if (count($data)) {
            Notification::insert($data);
            //foreach ($users as $toUser) {
                //$job = (new SendNotifyMail($type, $fromUser, $toUser, $topic, $reply, $content))
                //    ->delay(10);
                //dispatch($job);
            //}
        }
        //foreach ($data as $value) {
        //    self::pushNotification($value);
        //}
    }

    /**
     * Create a notification
     * @param  string $type     have 'at', 'new_reply', 'attention', 'append'
     * @param  User   $fromUser come from who
     * @param  array  $users    to who, array of users
     * @param Video   $video
     * @param Comment $comment
     * @param null    $content
     */
    public static function batchNotifyForVideo($type, User $fromUser, $users, Video $video, Comment $comment = null, $content = null)
    {
        $nowTimestamp = Carbon::now()->toDateTimeString();
        $data = [];
        foreach ($users as $toUser) {
            if ($fromUser->id == $toUser->id) {
                continue;
            }
            $data[] = [
                'from_user_id' => $fromUser->id,
                'user_id' => $toUser->id,
                'video_id' => $video->id,
                'body' => $content ?: ($comment ? $comment->content : ''),
                'type' => $type,
                'created_at' => $nowTimestamp,
                'updated_at' => $nowTimestamp
            ];
            $toUser->increment('notification_count', 1);
        }
        if (count($data)) {
            Notification::insert($data);
            //foreach ($users as $toUser) {
            //$job = (new SendNotifyMail($type, $fromUser, $toUser, $topic, $reply, $content))
            //    ->delay(10);
            //dispatch($job);
            //}
        }
    }

    /**
     * Create a notification
     * @param  string $type     have 'at', 'new_reply', 'attention', 'append'
     * @param  User   $fromUser come from who
     * @param  array  $users    to who, array of users
     * @param Post   $post
     * @param Comment $comment
     * @param null    $content
     */
    public static function batchNotifyForPost($type, User $fromUser, $users, Post $post, Comment $comment = null, $content = null)
    {
        $nowTimestamp = Carbon::now()->toDateTimeString();
        $data = [];
        foreach ($users as $toUser) {
            if ($fromUser->id == $toUser->id) {
                continue;
            }
            $data[] = [
                'from_user_id' => $fromUser->id,
                'user_id' => $toUser->id,
                'post_id' => $post->id,
                'body' => $content ?: ($comment ? $comment->content : ''),
                'type' => $type,
                'created_at' => $nowTimestamp,
                'updated_at' => $nowTimestamp
            ];
            $toUser->increment('notification_count', 1);
        }
        if (count($data)) {
            Notification::insert($data);
            //foreach ($users as $toUser) {
            //$job = (new SendNotifyMail($type, $fromUser, $toUser, $topic, $reply, $content))
            //    ->delay(10);
            //dispatch($job);
            //}
        }
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public static function notify($type, User $fromUser, User $toUser, Topic $topic = null, Reply $reply = null)
    {
        if ($fromUser->id == $toUser->id) {
            return;
        }
        if ($topic && Notification::isNotified($fromUser->id, $toUser->id, $topic->id, $type)) {
            return;
        }
        $nowTimestamp = Carbon::now()->toDateTimeString();
        $data = [
            'from_user_id' => $fromUser->id,
            'user_id' => $toUser->id,
            'video_id' => $topic ? $topic->id : 0,
            'reply_id' => $reply ? $reply->id : 0,
            'body' => $reply ? $reply->body : '',
            'type' => $type,
            'created_at' => $nowTimestamp,
            'updated_at' => $nowTimestamp
        ];
        $toUser->increment('notification_count', 1);
        Notification::insert([$data]);
        //$job = (new SendNotifyMail($type, $fromUser, $toUser, $topic, $reply))
        //    ->delay(config(10));
        //dispatch($job);
        //self::pushNotification($data);
    }

    public static function pushNotification($data)
    {
        $notification = Notification::query()
            ->with('fromUser', 'topic')
            ->where($data)
            ->first();
        if (!$notification) {
            return;
        }
        $from_user_name = $notification->fromUser->name;
        $topic_title = $notification->topic ? $notification->topic->title : '关注了你';
        $msg = $from_user_name
            . ' • ' . $notification->present()->lableUp()
            . ' • ' . $topic_title;
        $push_data = array_only(
            $data,
            [
                'topic_id',
                'from_user_id',
                'type',
            ]
        );
        if ($data['reply_id'] !== 0) {
            $push_data['reply_id'] = $data['reply_id'];
            // $push_data['replies_url'] = route('replies.web_view', $data['reply_id']);
        }
    }

    public static function isNotified($from_user_id, $user_id, $topic_id, $type)
    {
        $notifys = Notification::fromwhom($from_user_id)
            ->toWhom($user_id)
            ->atTopic($topic_id)
            ->withType($type)->get();

        return $notifys->count();
    }

    public function scopeFromWhom($query, $from_user_id)
    {
        return $query->where('from_user_id', '=', $from_user_id);
    }

    public function scopeToWhom($query, $user_id)
    {
        return $query->where('user_id', '=', $user_id);
    }

    public function scopeWithType($query, $type)
    {
        return $query->where('type', '=', $type);
    }

    public function scopeAtTopic($query, $topic_id)
    {
        return $query->where('topic_id', '=', $topic_id);
    }
}

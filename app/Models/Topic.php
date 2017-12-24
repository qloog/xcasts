<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Overtrue\LaravelFollow\Traits\CanBeFollowed;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Carbon\Carbon;

class Topic extends Model implements Transformable
{
    use TransformableTrait;
    use CanBeFollowed;

    protected $table = 'forum_topics';

    protected $fillable = [
        'id','category_id','title','body','origin_body', 'view_count', 'reply_count', 'vote_count',
        'is_excellent','is_blocked','last_reply_user_id','last_reply_time_at', 'source','user_id',
        'created_at', 'updated_at'
    ];

    public function getLastReplyTimeAtAttribute($date)
    {
        return Carbon::parse($date);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function attentedUsers()
    {

    }

    public function lastReplyUser()
    {
        return $this->belongsTo(User::class, 'last_reply_user_id');
    }

    public function scopeWhose($query, $userId)
    {
        return $query->where('user_id', '=', $userId);
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    public function votes()
    {
        return $this->morphMany(Vote::class, 'votable');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Reply extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'forum_replies';

    protected $fillable = ['topic_id','origin_body','body','vote_count','is_blocked','source','user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function scopeWhose($query, $userId)
    {
        return $query->where('user_id', '=', $userId)->with('topic');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

}

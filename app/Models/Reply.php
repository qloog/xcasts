<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Reply extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'forum_replies';

    protected $fillable = ['id','topic_id','origin_body','body','vote_count','is_blocked','source','user_id','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

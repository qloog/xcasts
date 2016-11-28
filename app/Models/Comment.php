<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use App\Models\User;

class Comment extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['type', 'relation_id', 'ip','content','user_id', 'up_count', 'device_type', 'updated_at', 'created_at'];

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

}

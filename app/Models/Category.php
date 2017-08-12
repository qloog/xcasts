<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Category extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'forum_categories';

    protected $fillable = [
        'id','name','slug','description', 'weight', 'topic_count','user_id','created_at', 'updated_at'
    ];
}


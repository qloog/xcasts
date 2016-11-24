<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Topic extends Model implements Transformable
{
    use TransformableTrait;

    protected $table = 'forum_topics';

    protected $fillable = ['title','body','origin_body'];

}

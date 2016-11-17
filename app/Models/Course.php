<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Course extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['id', 'name', 'slug', 'description', 'cover_image', 'created_at', 'updated_at'];

    public function videos()
    {
        return $this->hasMany(Video::class);
    }

}

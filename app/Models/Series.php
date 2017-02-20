<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Series extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['id', 'name', 'slug', 'description', 'cover_image', 'created_at', 'updated_at'];

    public function lessons()
    {
        return $this->hasMany(Lesson::class);
    }

    public function scopeType($query, $type)
    {
        return $query->where('type', '=', $type);
    }

}

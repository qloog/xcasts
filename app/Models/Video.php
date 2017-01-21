<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Video extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'course_id',
        'name',
        'description',
        'cover_image',
        'url',
        'cdn_url',
        'is_free',
        'length',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}

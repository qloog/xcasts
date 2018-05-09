<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Course extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id', 'type', 'name', 'slug', 'description', 'cover_image', 'is_publish', 'published_at', 'created_at', 'updated_at'
    ];

    /**
     * 获取当前课程的所有视频
     * @return $this
     */
    public function videos()
    {
        return $this->hasMany(Video::class)->where('is_publish','=',1)->orderBy('episode_id','ASC');
    }

    /**
     * 根据类型查询视频
     *
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', '=', $type);
    }

}

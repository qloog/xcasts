<?php

namespace App\Models;

use App\Services\QiNiuService;
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

    /**
     * @param $query
     * @param $type
     * @return mixed
     */
    public function scopeType($query, $type)
    {
        return $query->where('type', '=', $type);
    }

}

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

    public function handleCoverImage($data)
    {
        if (!$data) {
            return $data;
        }

        $qiNiuSrv = new QiNiuService();
        foreach ($data as &$item) {
            $item->cover_image = $qiNiuSrv->fileUrlWithToken($item->cover_image);
        }

    }

    public function getCoverImageAttribute($coverImage)
    {
        $coverImage = 'http://statics.phpcasts.org' . $coverImage;
        $qiNiuSrv = new QiNiuService();
        return $this->attributes['cover_image'] = $qiNiuSrv->fileUrlWithToken($coverImage);
    }

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

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Goods extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id', 'name', 'introduction', 'price', 'promotion_price', 'promotion_start', 'promotion_end',
        'user_id', 'created_at', 'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

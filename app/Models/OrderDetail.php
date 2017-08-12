<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class OrderDetail extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id','order_id','goods_id','goods_name','goods_price','quantity','expired_at','user_id', 'created_at','updated_at'
    ];

}

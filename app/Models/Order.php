<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Order extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id','order_amount','pay_amount','quantity','is_paid','paid_at', 'qrcode_id', 'completed_at','status','user_id',
        'created_at','updated_at'
    ];

}

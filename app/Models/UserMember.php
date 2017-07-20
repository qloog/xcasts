<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserMember extends Model
{
    protected $fillable = [
        'id','type','start_time','end_time','user_id', 'status', 'created_at','updated_at'
    ];
}

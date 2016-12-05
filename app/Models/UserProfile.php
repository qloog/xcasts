<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $table = 'user_profiles';

    protected $fillable = ['id','user_id','realname','avatar','weibo','wechat','city','company','website','introduction',
        'created_at', 'updated_at'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedbacks';

    protected $fillable = ['id','content','user_id','created_at','updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

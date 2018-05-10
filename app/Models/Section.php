<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $table = 'sections';

    protected $fillable = [
        'id','course_id','name','order', 'created_at', 'updated_at'
    ];

    public function videos()
    {
        return $this->hasMany(Video::class, 'section_id', 'id');
    }
}

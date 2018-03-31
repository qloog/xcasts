<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Post extends Model implements Transformable
{
    use TransformableTrait;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'slug',
        'summary',
        'origin_content',
        'content',
        'user_id',
        'status',
        'created_at',
        'updated_at'
    ];

    //
    public function hasManyComments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}

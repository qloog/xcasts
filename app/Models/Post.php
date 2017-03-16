<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Post
 *
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property integer $user_id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Comment[] $hasManyComments
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereSlug($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereContent($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Post whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Post extends Model
{

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
        'content',
        'user_id',
        'created_at',
        'updated_at'
    ];

	//
    public function hasManyComments()
    {
        return $this->hasMany('App\Models\Comment', 'post_id', 'id');
    }

}

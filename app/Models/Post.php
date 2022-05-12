<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Scout\Searchable;

class Post extends Model
{
    use HasFactory, Searchable, SoftDeletes;

    protected $table = 'posts';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'image_path'       
    ];

    public function searchableAs()
    {
        return 'posts';
    }

    public function likedBy(User $user)
    {
        return $this->likes->contains('user_id', $user->id);
    }

    public function sharedBy(User $user)
    {
        return $this->shares->contains('user_id', $user->id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function shares()
    {
        return $this->hasMany(Share::class);
    }
    
    /** Soft Delete related likes and comments of a soft deleted post.
     * Bootstrap the model and its traits.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();

        self::deleting(function ($posts) {
            
            // Softdelete associated post likes, comments.       
            $posts->likes()->each(function ($likes) {
                $likes->delete();
            });

            $posts->comments()->each(function ($comments) {
                $comments->delete();
            });

        });
    }

}

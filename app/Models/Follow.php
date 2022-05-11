<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Follow extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'followers';

    protected $fillable = [
        'follower_id',
    ];

     /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class, 'user_id', 'id');
    }


}

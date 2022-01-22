<?php

namespace App\Models;

use App\Concern\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, Likeable, SoftDeletes;

    protected $fillable = ['content', 'post_id', 'user_id'];

    public function scopeSearch($query, $key)
    {
        return $query->Where('content', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc');
    }

    public function posts()
    {
        return $this->belongsTo(Post::class, 'post_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}

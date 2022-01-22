<?php

namespace App\Models;

use App\Concern\Likeable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\Providers\JWT;

class Post extends Model
{
    use HasFactory, Likeable, SoftDeletes;

    protected $fillable = ['content', 'user_id'];

    protected $casts = [
        'created_at' => 'datetime:Y-m-d',
        'updated_at' => 'datetime:Y-m-d',
    ];

    public function scopeSearch($query, $key)
    {
        return $query->Where('content', 'like', "%{$key}%")
            ->orderBy('created_at', 'desc');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }
}

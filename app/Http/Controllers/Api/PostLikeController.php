<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

class PostLikeController extends Controller
{
    public function like(Post $post)
    {
        return $post->like();
    }

    public function dislike(Post $post)
    {
        return $post->dislike();
    }

    public function sum(Post $post)
    {
        return $post->sumLike($post, $post->id);
    }

    public function post(Post $post)
    {
        
    }
}

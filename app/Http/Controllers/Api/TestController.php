<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

class TestController extends Controller
{
    public function sqlTest(Post $post)
    {
        //DB::connection()->enableQueryLog();

        //$post = Post::with('comments')->get();

        $post = Post::get();
        $comments = $post->comments;
        return $comments;

        //dd(DB::getQueryLog());
    }

    public function test()
    {
        $start = microtime(true);
        CommentResource::collection(Comment::get());
        $time = microtime(true) - $start;
        return $time;
    }
}

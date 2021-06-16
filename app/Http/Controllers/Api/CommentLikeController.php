<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;

class CommentLikeController extends Controller
{
    public function like(Comment $comment)
    {
        return $comment->like();
    }

    public function dislike(Comment $comment)
    {
        return $comment->dislike();
    }

    public function sum(Comment $comment)
    {
        return $comment->sumLike($comment, $comment->id);
    }
}

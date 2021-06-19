<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;

/**
 * @group CommentLike endpoint
 */
class CommentLikeController extends Controller
{
    
    /**
     * create or destroy comment like
     * 
     * @authenticated
     * 
     * @urlParam comment integer required The ID of the comment. emxample: 1
     * 
     * @response 200 {
     *     'message':'Success. Has been like'
     * }
     * 
     * @response 200 {
     *     'message':'Success. Has been cancel like'
     * }
     * 
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     */

    public function like(Comment $comment)
    {
        return $comment->like();
    }

    // public function dislike(Comment $comment)
    // {
    //     return $comment->dislike();
    // }

    /**
     * show comment total like
     * 
     * @urlParam comment integer required The ID of the comment. emxample: 1
     * 
     * 
     * @response 200 {
     *     "number of the comment like": 100,
     *     "message": "Success"
     * }
     * 
     */


    public function sum(Comment $comment)
    {
        return $comment->sumLike($comment, $comment->id);
    }
}

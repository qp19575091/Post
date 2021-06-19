<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Post;

/**
 * @group PostLike endpoint
 */
class PostLikeController extends Controller
{
    /**
     * create or destroy post like
     * 
     * @authenticated
     * 
     * @urlParam post integer required The ID of the post. emxample: 1
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

    public function like(Post $post)
    {
        return $post->like();
    }

    /**
     * show post total like
     * 
     * @urlParam post integer required The ID of the post. emxample: 1
     * 
     * 
     * @response 200 {
     *     "number of the post like": 100,
     *     "message": "Success"
     * }
     * 
     */

    public function sum(Post $post)
    {
        $sum = $post->sumLike($post, $post->id);
        
        return $sum;
    }
}

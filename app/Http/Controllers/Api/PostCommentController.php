<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * @group PostComment endpoint
 */
class PostCommentController extends Controller
{
    /**
     * create comments by users
     *
     * @authenticated
     * 
     * @urlParam post integer required The ID of the post. emxample: 1
     * @bodyParam comment string required the content of the user. emxample: This is a comment
     * 
     * @response 200 {
     *     "id": 1010,
     *     "content": "This is a comment",
     *     "user_id": 1,
     *     "post_id": 1
     * }
     * 
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     */
    public function store(Request $request, Post $post)
    {
        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);

        return response()->json(new CommentResource($comment), 200);
    }

    /**
     * response all comments of specified post
     *
     * @urlParam post integer required The ID of the post. emxample: 1
     * 
     * @response 200{
     *     {
     *         "id": 10,
     *         "content": "Aliquam vel modi.",
     *         "user_id": 3,
     *         "post_id": 4
     *     },      
     *     {      
     *         "id": 69,
     *         "content": "Et perspiciatis.",
     *         "user_id": 1,
     *         "post_id": 4
     *     }
     * }
     *
     */
    public function showPostComment(Post $post)
    {
        return CommentResource::collection($post->comments()->get());
    }
}

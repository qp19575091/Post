<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Support\Facades\Redis;

/**
 * @group Comment endpoint
 */
class CommentController extends Controller
{

    /**
     * response all comments
     * 
     * 
     * 
     * @response 200{
     *     {
     *          "id": 1,
     *          "content": "This is a comment1.",
     *          "user_id": 1,
     *          "post_id": 7
     *     }, 
     *     {
     *          "id": 2,
     *          "content": "This is a comment2.",
     *          "user_id": 1,
     *          "post_id": 22
     *      },
     * }
     *
     * 
     * 
     */
    public function index()
    {
        Redis::get('comment') ??
        Redis::set('comment', json_encode(CommentResource::collection(Comment::get())));
        $comment = Redis::get('comment');
        return json_decode($comment);
    }



    /**
     * response specified comment
     *
     * 
     * 
     * @response 200{
     *     "id": 1,
     *     "post_id": 7,
     *     "user_id": 1,
     *     "content": "This is a comment.",
     * }
     *
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * 
     */
    public function show(Comment $comment)
    {
        return new CommentResource($comment);
    }

    /**
     * update auth's comment by himself
     *
     * @authenticated
     * 
     * @bodyParam content string require the content of the post. Emxample: Update a comment.
     * 
     * @response 200{
     *     "id": 1,
     *     "post_id": 7,
     *     "user_id": 1,
     *     "content": "Update a comment.",
     * }
     *
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * {
     * 
     * @response status=403 scenario="Unauthenticated" {
     *     "message": "No Permission."
     * }
     *
     */
    public function update(Request $request, Comment $comment)
    {
        $comment = Comment::where('id', $comment->id)->where('user_id', auth()->user()->id)->first();

        if ($comment) {
            $comment->update(['content' => $request->content]);
            return new CommentResource($comment);
        }

        return response()->json(['message' => 'No Permission'], 403);
    }

    /**
     * delete auth's comment by himself
     *
     * @authenticated
     * 
     * @response 204{
     *     
     * }
     * 
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     * 
     * @response status=403 scenario="Unauthenticated" {
     *     "message": "No Permission."
     * }
     * 
     */
    public function destroy(Comment $comment)
    {
        $comment = Comment::where('id', $comment->id)->where('user_id', auth()->user()->id)->first();

        if ($comment) {
            $comment->delete();
            return response()->noContent();
        }
        return response()->json(['message' => 'No Permission'], 403);
    }
}

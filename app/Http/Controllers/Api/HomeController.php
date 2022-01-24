<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Redis;
use Symfony\Component\HttpFoundation\Response;

/**
 * @group Home endpoints
 */
class HomeController extends Controller
{
    public $key;

    public function __construct(Request $request, $key = '')
    {
        $key = trim($request->get('query'));
        $this->key = $key;
    }

    /**
     * Search the Users by keyword.
     *
     * @bodyParam key key required The key of the username. Example: Jack
     *
     * @response 200 {
     *     "id": 2,
     *     "name": "Demo",
     *     "email": "demo@demo.com",
     *     "email_verified_at": null,
     *     "created_at": "2020-05-25T06:21:47.000000Z",
     *     "updated_at": "2020-05-25T06:21:47.000000Z"
     * }
     */
    public function searchUser()
    {
        $users = User::search($this->key)->get();

        return response()->json($users, Response::HTTP_OK);
    }

    /**
     * Search the posts by keyword.
     *
     * @bodyParam key key required The key of the posts content. Example: Jack
     *
     * @response 200 {
     *     @response 200{
     *     "id": 1,
     *     "user_id": 1,
     *     "content": "Update a comment.",
     * }
     * 
     */
    public function searchPost()
    {
        $posts = Post::search($this->key)->get();

        return response()->json($posts, Response::HTTP_OK);
    }

    /**
     * Search the comments by keyword.
     *
     * @bodyParam key key required The key of the comments content. Example: Jack
     *
     * @response 200 {
     *     @response 200{
     *     "id": 1,
     *     "post_id": 7,
     *     "user_id": 1,
     *     "content": "Update a comment.",
     * }
     * 
     */
    public function searchComment()
    {
        $comments = Comment::search($this->key)->get();

        return response()->json($comments, Response::HTTP_OK);
    }
}

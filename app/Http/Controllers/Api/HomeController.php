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
     * @param Request $request
     *
     * @return mixed
     */
    public function searchUser()
    {
        $users = User::search($this->key)->get();

        return response()->json($users, Response::HTTP_OK);
    }

    /**
     * Search the posts by keyword.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function searchPost()
    {
        $posts = Post::search($this->key)->get();

        return response()->json($posts, Response::HTTP_OK);
    }

    /**
     * Search the comments by keyword.
     *
     * @param Request $request
     *
     * @return mixed
     */
    public function searchComment()
    {
        $comments = Comment::search($this->key)->get();

        return response()->json($comments, Response::HTTP_OK);
    }
}

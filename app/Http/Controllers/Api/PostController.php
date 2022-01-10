<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;


/**
 * @group Post endpoint
 */
class PostController extends Controller
{

    /**
     * response all posts
     * 
     * 
     * 
     * @response 200{
     *     {
     *          "id": 1,
     *          "content": "This is a post1.",
     *          "user_id": 1,
     *     }, 
     *     {
     *          "id": 2,
     *          "content": "This is a post2.",
     *          "user_id": 2,
     *      },
     * }
     *
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     * 
     */
    public function index()
    {
        return PostResource::collection(Post::with('users')->latest()->simplepaginate(10));
    }

    /**
     * create posts by users
     *
     * @authenticated
     * 
     * 
     * @bodyParam post string required the content of the user. emxample: This is a post
     * 
     * @response 200 {
     *     "id": 1010,
     *     "content": "This is a post",
     *     "user_id": 1,
     * }
     * 
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'user_id' => auth()->user()->id,
            'content' => $request->content,
        ]);
        return response()->json(new PostResource($post), 201);
    }
            
    /**
     * response specified post
     *
     * 
     * 
     * @response 200{
     *     "id": 1,
     *     "user_id": 1,
     *     "content": "This is a post.",
     * }
     *
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     */
    public function show(Post $post)
    {
        return new PostResource($post);
    }

    /**
     * update auth's post by himself
     *
     * @authenticated
     * 
     * @bodyParam content string require the content of the post. Emxample: Update a post.
     * 
     * @response 200{
     *     "id": 1,
     *     "user_id": 1,
     *     "content": "Update a post.",
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
    public function update(PostRequest $request, Post $post)
    {
        $post->update($request->validated());
        return new PostResource($post);
    }

    /**
     * delete auth's post by himself
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
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->noContent();
    }

    public function __construct()
    {
        $this->authorizeResource(Post::class);
    }
}

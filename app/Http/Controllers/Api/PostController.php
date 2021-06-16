<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;

/**
 * @group 貼文 Post endpoint
 */
class PostController extends Controller
{
    /**
     * 印出所有用戶的所有貼文 response all posts of all users
     *
     * @response 200{
     *     "id": 1,
     *     "user_id": 8,
     *     "content": "Aut accusantium.",
     *     "created_at": "2021-05-18T14:29:02.000000Z",
     *     "updated_at": "2021-05-18T14:29:02.000000Z"
     * }
     */
    public function index()
    {
        return PostResource::collection(Post::get());
    }

    /**
     * 儲存用戶新增的貼文 save posts add by users
     *
     * @bodyParam user_id integer require the user_id of the user. emxample: 1
     * @bodyParam content string require the content of the user. emxample: This is a content of post
     *
     */
    public function store(Request $request)
    {
        $post = Post::create([
            'user_id' => 1,
            'content' => $request->content,
        ]);
        return $post;
    }

    /**
     * 印出指定的貼文 response specified post
     *
     * @response 200{
     *     "id": 1,
     *     "user_id": 8,
     *     "content": "Aut accusantium.",
     *     "created_at": "2021-05-18T14:29:02.000000Z",
     *     "updated_at": "2021-05-18T14:29:02.000000Z"
     * }
     */
    public function show($id)
    {
        return PostResource::collection(Post::findorfail($id));
    }

    /**
     * 修改指定的貼文 edit specified post
     *
     * @bodyParam user_id integer require the user_id of the user. emxample: 1
     * @bodyParam content string require the content of the user. emxample: This is a content of post
     *
     */
    public function update(Request $request, Post $post)
    {
        $post = $post->update([
            'content' => $request->content,
        ]);
        return $post;
    }

    /**
     * 刪除指定的貼文 delete specified post
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        return $post->delete();
    }
}

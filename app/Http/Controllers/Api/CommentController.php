<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Models\Post;

/**
 * @group 評論 Comment endpoint
 */
class CommentController extends Controller
{

    /**
     * 印出所有用戶的所有評論 response all comments of all users
     *
     * @response 200{
     *     "id": 1,
     *     "post_id": 7,
     *     "user_id": 3,
     *     "comment": "Repellendus.",
     *     "created_at": "2021-05-18T14:29:02.000000Z",
     *     "updated_at": "2021-05-18T14:29:02.000000Z"
     * }
     *
     */
    public function index()
    {
        return CommentResource::collection(Comment::get());
    }

    /**
     * 儲存用戶新增的評論 save comments add by users
     *
     * @bodyParam comment string require the content of the user. emxample: This is a comment
     *
     */
    public function store(Request $request, Post $post)
    {
        $comment = Comment::create([
            'content' => $request->content,
            'user_id' => auth()->user()->id,
            'post_id' => $post->id,
        ]);
        return $comment;
    }

    /**
     * 印出指定的評論 response specified comment
     *
     * @response 200{
     *     "id": 1,
     *     "post_id": 7,
     *     "user_id": 3,
     *     "comment": "Repellendus.",
     *     "created_at": "2021-05-18T14:29:02.000000Z",
     *     "updated_at": "2021-05-18T14:29:02.000000Z"
     * }
     *
     */
    public function show($id)
    {
        return CommentResource::collection(Comment::findorfail($id));
    }

    /**
     * 修改指定的評論 edit specified comment
     *
     * @bodyParam comment string require the comment of the post. Emxample: This is a comment
     *
     */
    public function update(Request $request, Comment $comment)
    {
        $comment = $comment->update([
            'content' => $request->content,
        ]);
        return $comment;
    }

    /**
     * 刪除指定的評論 delete specified comment
     *
     */
    public function destroy(Comment $comment)
    {
        return $comment->delete();
    }
}

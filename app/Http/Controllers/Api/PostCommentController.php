<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\Post;

class PostCommentController extends Controller
{
    /**
     * 印出該貼文的所有評論 response all comments of specified post
     *
     * @response 200{
     *     "id": 1,
     *     "user_id": 8,
     *     "content": "Aut accusantium.",
     *     "created_at": "2021-05-18T14:29:02.000000Z",
     *     "updated_at": "2021-05-18T14:29:02.000000Z",
     *     "comments": [
     *         {
     *             "id": 5,
     *             "post_id": 1,
     *             "user_id": 5,
     *             "comment": "Nostrum architecto.",
     *             "created_at": "2021-05-18T14:29:02.000000Z",
     *             "updated_at": "2021-05-18T14:29:02.000000Z"
     *         },
     *         {
     *             "id": 17,
     *             "post_id": 1,
     *             "user_id": 10,
     *             "comment": "Incidunt labore cum.",
     *             "created_at": "2021-05-18T14:29:03.000000Z",
     *             "updated_at": "2021-05-18T14:29:03.000000Z"
     *         },
     * }
     *
     */
    public function showPostComment($id)
    {
        return CommentResource::collection(Post::with('comments')->where('id', $id)->get());
    }
}

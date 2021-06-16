<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\User;

class UserCommentController extends Controller
{
    /**
     * 印出該用戶的所有評論 response all comments of specified user
     *
     * @bodyParam id integer require the user_id of the user. emxample: 1
     *
     * @response 200{
     *     "id": 1,
     *     "name": "Rocio Hermiston",
     *     "created_at": "2021-05-18T14:29:02.000000Z",
     *     "updated_at": "2021-05-18T14:29:02.000000Z",
     *     "comments": [
     *         {
     *             "id": 27,
     *             "post_id": 3,
     *             "user_id": 1,
     *             "comment": "Illo optio non.",
     *             "created_at": "2021-05-18T14:29:03.000000Z",
     *             "updated_at": "2021-05-18T14:29:03.000000Z"
     *         },
     *        {
     *             "id": 29,
     *             "post_id": 5,
     *             "user_id": 1,
     *             "comment": "Suscipit sunt animi.",
     *             "created_at": "2021-05-18T14:29:03.000000Z",
     *             "updated_at": "2021-05-18T14:29:03.000000Z"
     *         },
     * }
     *
     */
    public function comment(User $user)
    {
        return CommentResource::collection($user->comments()->get());
    }
}

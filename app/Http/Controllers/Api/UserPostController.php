<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\User;

class UserPostController extends Controller
{
    /**
     * 印出該用戶的所有文章 response all posts of specified user
     *
     * @bodyParam id integer require the user_id of the user. emxample: 1
     *
     * @response 200{
     *     "id": 1,
     *     "name": "Rocio Hermiston",
     *     "created_at": "2021-05-18T14:29:02.000000Z",
     *     "updated_at": "2021-05-18T14:29:02.000000Z",
     *     "posts": [
     *         {
     *             "id": 3,
     *             "user_id": 1,
     *             "content": "Consectetur.",
     *             "created_at": "2021-05-18T14:29:02.000000Z",
     *             "updated_at": "2021-05-18T14:29:02.000000Z"
     *         },
     *         {
     *             "id": 6,
     *             "user_id": 1,
     *             "content": "Voluptate ullam.",
     *             "created_at": "2021-05-18T14:29:02.000000Z",
     *             "updated_at": "2021-05-18T14:29:02.000000Z"
     *         },
     * }
     *
     */
    public function post(User $user)
    {
        return PostResource::collection($user->posts()->get());
    }
}

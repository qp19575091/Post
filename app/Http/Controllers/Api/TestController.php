<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

class TestController extends Controller
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
        return Comment::get();
    }
}

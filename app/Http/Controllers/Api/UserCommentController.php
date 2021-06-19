<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CommentResource;
use App\Models\User;

/**
 * @group UserComment endpoint
 */
class UserCommentController extends Controller
{
    /**
     * response all comments of auth user
     *
     * @authenticated
     * 
     * @urlParam user integer required The ID of the user. emxample: 1
     *
     * @response 200{
     *     {
     *         "id": 27,
     *         "post_id": 3,
     *         "user_id": 1,
     *         "comment": "Illo optio non.",
     *     },
     *     {
     *         "id": 29,
     *         "post_id": 5,
     *         "user_id": 1,
     *         "comment": "Suscipit sunt animi.",
     *     },
     * }
     * 
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     * 
     */
    public function comment(User $user)
    {
        $user = User::where('id', auth()->user()->id)->first();

        if($user){
            $comments = $user->comments()->get();
            return CommentResource::collection($comments);
        }
    }
}

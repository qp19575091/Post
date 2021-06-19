<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\User;

/**
 * @group UserPost endpoint
 */
class UserPostController extends Controller
{
    /**
     * response all posts of specified user
     *
     * @urlParam user integer required The ID of the user. emxample: 1
     *
     * @response 200{
     *     {
     *         "id": 1,
     *         "user_id": 1,
     *         "content": "Consectetur.",
     *     },
     *     {
     *         "id": 2,
     *         "user_id": 1,
     *         "content": "Voluptate ullam.",    
     *     },
     * }
     * 
     * @response status=401 scenario="Unauthenticated" {
     *     "message": "Unauthenticated."
     * }
     * 
     */
    public function post(User $user)
    {
        $user = User::where('id', auth()->user()->id)->first();

        if($user){
            $posts = $user->posts()->get();
            return PostResource::collection($posts);;
        }
    }
}

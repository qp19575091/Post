<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['middleware' => 'role:user', 'prefix' => 'user'], function () {
    });

    Route::group(['middleware' => 'role:admin', 'prefix' => 'admin'], function () {
        // Route::apiresource('posts', Api\Admin\PostController::class);
    });

    //get user's following
    Route::get('users.following', [Api\UserController::class, 'following']);
    //get user's follower
    Route::get('users.followers', [Api\UserController::class, 'follower']);
    //user can follow
    Route::post('users.follow', [Api\UserController::class, 'follow']);

    //get auth user posts
    Route::get('users.posts', [Api\UserPostController::class, 'post']);
    //get auth user comments
    Route::get('users.comments', [Api\UserCommentController::class, 'comment']);

    //posts resource
    Route::apiresource('posts', Api\PostController::class)->only('store', 'destroy', 'update');
    //comments resource
    Route::apiresource('comments', Api\CommentController::class)->only('destroy', 'update');

    //store posts comments
    Route::apiResource('posts.comments', Api\PostCommentController::class)->only('store');

    //posts can likes
    Route::post('posts/{post}/likes', [Api\PostLikeController::class, 'like']);
    //comments can likes
    Route::post('comments/{comment}/likes', [Api\CommentLikeController::class, 'like']);

    //user logout
    Route::post('/logout', [Api\UserController::class, 'logout']);
    //get auth user information
    Route::apiResource('users', Api\UserController::class)->only('index');
});
//user register
Route::post('register', [Api\UserController::class, 'register']);
//user login
Route::post('login', [Api\UserController::class, 'login']);

//posts resource
Route::apiresource('posts', Api\PostController::class)->only('index', 'show');

//comments resource
Route::apiresource('comments', Api\CommentController::class)->only('index', 'show');
//show comments on specific posts
Route::get('posts.comments/{post}', [Api\PostCommentController::class, 'showPostComment']);

//get total likes of post
Route::get('posts/{post}/likes', [Api\PostLikeController::class, 'sum']);
//get total likes of comment
Route::get('comments/{comment}/likes', [Api\CommentLikeController::class, 'sum']);

//search 
Route::get('dashboard/users', [Api\HomeController::class, 'SearchUser']);
Route::get('dashboard/comments', [Api\HomeController::class, 'SearchComment']);
Route::get('dashboard/posts', [Api\HomeController::class, 'SearchPost']);

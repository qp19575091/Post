<?php

use Illuminate\Http\Request;
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

Route::middleware('auth:api')->group(function () {
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

//get auth user posts
Route::get('users.posts', [Api\UserPostController::class, 'post']);
//get auth user comments
Route::get('users.comments', [Api\UserCommentController::class, 'comment']);

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

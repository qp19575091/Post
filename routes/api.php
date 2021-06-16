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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:api')->group(function () {
    //get user posts
    Route::get('users.posts/{user}', [Api\UserPostController::class, 'post']);
    //get user comments
    Route::get('users.comments/{user}', [Api\UserCommentController::class, 'comment']);

    //posts resource
    Route::apiresource('posts', Api\PostController::class)->except('show');
    Route::get('posts/{id}', [Api\PostController::class, 'show']);

    //posts likes
    Route::get('posts/{post}/likes', [Api\PostLikeController::class, 'sum']);
    Route::post('posts/{post}/likes', [Api\PostLikeController::class, 'like']);
    Route::delete('posts/{post}/likes', [Api\PostLikeController::class, 'dislike']);

    //comments resource
    Route::apiresource('comments', Api\CommentController::class)->except('show');
    Route::get('comments/{id}', [Api\CommentController::class, 'show']);

    //comments likes
    Route::get('comments/{comment}/likes', [Api\CommentLikeController::class, 'sum']);
    Route::post('comments/{comment}/likes', [Api\CommentLikeController::class, 'like']);
    Route::delete('comments/{comment}/likes', [Api\CommentLikeController::class, 'dislike']);

    //show comments on specific posts
    Route::get('posts.comments/{id}', [Api\PostCommentController::class, 'showPostComment']);

});
//user authenticate
Route::post('user-create', [Api\UserController::class, 'store']);
Route::post('login', [Api\UserController::class, 'login']);
Route::post('/logout', [Api\UserController::class, 'logout']);
Route::apiResource('users', Api\UserController::class)->only('index');

//test
Route::get('test', [Api\TestController::class, 'test']);

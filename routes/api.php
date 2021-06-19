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
    //get user posts
    Route::get('users.posts', [Api\UserPostController::class, 'post']);
    //get user comments
    Route::get('users.comments', [Api\UserCommentController::class, 'comment']);

    //posts resource
    Route::apiresource('posts', Api\PostController::class);
    //Route::get('posts/{id}', [Api\PostController::class, 'show']);

    //posts likes
    Route::get('posts/{post}/likes', [Api\PostLikeController::class, 'sum']);
    Route::post('posts/{post}/likes', [Api\PostLikeController::class, 'like']);
    //Route::delete('posts/{post}/likes', [Api\PostLikeController::class, 'dislike']);

    //comments resource
    Route::apiresource('comments', Api\CommentController::class);

    //comments likes
    Route::get('comments/{comment}/likes', [Api\CommentLikeController::class, 'sum']);
    Route::post('comments/{comment}/likes', [Api\CommentLikeController::class, 'like']);
    //Route::delete('comments/{comment}/likes', [Api\CommentLikeController::class, 'dislike']);

    //show comments on specific posts
    Route::get('posts.comments/{post}', [Api\PostCommentController::class, 'showPostComment']);
    Route::apiResource('posts.comments', Api\PostCommentController::class)->only('store');
    
    //user authenticate
    Route::post('/logout', [Api\UserController::class, 'logout']);
    Route::apiResource('users', Api\UserController::class)->only('index');
});


//user authenticate
Route::post('register', [Api\UserController::class, 'register']);
Route::post('login', [Api\UserController::class, 'login']);


//test
Route::get('test', [Api\TestController::class, 'test']);

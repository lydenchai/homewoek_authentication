<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('users', [UserController::class, 'register']);
Route::post('user', [UserController::class, 'login']);

// Post
Route::get('posts', [PostController::class, 'index']);
Route::get('posts/{id}', [PostController::class, 'show']);

// Private route
Route::group(['middleware' => ['auth:sanctum']], function(){
    // user
    Route::post('users', [UserController::class, 'logout']);

    // Post
    Route::post('posts', [PostsController::class, 'store']);
    Route::post('posts/{id}', [PostsController::class, 'update']);
    Route::post('posts/{id}', [PostsController::class, 'destroy']);
});

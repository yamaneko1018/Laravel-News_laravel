<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PostController::class, 'index'])
   ->name('posts.index');   //ルーティングに名前をつけてviewではその名前を使用する

Route::get('/posts/{post}', [PostController::class, 'show']) //パラメータの名前をpostとする
   ->name('posts.show')
   ->where('post', '[0-9]+'); //Postについては数値しか受け付けない

Route::post('/posts/store', [PostController::class, 'store'])
   ->name('posts.store');

Route::post('/posts/{post}/comments', [CommentController::class, 'store'])
   ->name('comments.store')
   ->where('post', '[0-9]+');

Route::delete('/comments/{comment}/destroy', [CommentController::class, 'destroy'])
   ->name('comments.destroy')
   ->where('comment', '[0-9]+');



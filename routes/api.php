<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CollectionController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ConsumerController;
use App\Http\Controllers\Api\RankListController;
use App\Http\Controllers\Api\SingerController;
use App\Http\Controllers\Api\SongController;
use App\Http\Controllers\Api\SongListController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::get('/test', function () {
    \App\Models\Singer::changePicPath();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::delete('/logout', [AuthController::class, 'logout']);
    Route::put('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});

Route::group([
    'prefix' => 'user'
], function () {
    Route::get('/detail', [ConsumerController::class, 'detail']);
    Route::post('/add', [ConsumerController::class, 'signUp']);
});

Route::group([
    'prefix' => 'song'
], function () {
    Route::get('/singer/detail', [SongController::class, 'songOfSinger']);
    Route::get('/listSong/detail', [SongController::class, 'songOfList']);
    Route::get('/singerName/detail', [SongController::class, 'searchSong']);

});

Route::group([
    'prefix' => 'collection'
], function () {
    Route::post('/add', [CollectionController::class, 'store']);
});


Route::group([
    'prefix' => 'comment'
], function () {

    Route::get('/songList/detail', [CommentController::class, 'commentOfList']);
    Route::get('/song/detail', [CommentController::class, 'commentOfSong']);
    Route::post('/add', [CommentController::class, 'addComment']);
    Route::post('/like', [CommentController::class, 'likeComment']);
});

Route::group([
    'prefix' => 'rankList'
], function () {

    Route::get('/', [RankListController::class, 'index']);
    Route::post('/add', [RankListController::class, 'add']);
});


Route::group([
    'prefix' => 'songList'
], function () {
    Route::get('/', [SongListController::class, 'index']);
    Route::get('/detail', [SongListController::class, 'detail']);
    Route::get('/likeTitle/detail', [SongListController::class, 'searchList']);
    Route::get('/style/detail', [SongListController::class, 'index']);
});

Route::group([
    'prefix' => 'singer'
], function () {
    Route::get('/', [SingerController::class, 'index']);
    Route::get('/sex/detail', [SingerController::class, 'index']);
});



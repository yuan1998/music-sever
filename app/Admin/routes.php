<?php

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Dcat\Admin\Admin;

Admin::routes();

Route::group([
    'prefix'     => config('admin.route.prefix'),
    'namespace'  => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {

    $router->get('/', 'HomeController@index');
    $router->resource('/singer',"SingerController");
    $router->resource('/song',"SongController");
    $router->resource('/song_list',"SongListController");
    $router->resource('/consumer',"ConsumerController");
    $router->resource('/comment',"CommentController");
});

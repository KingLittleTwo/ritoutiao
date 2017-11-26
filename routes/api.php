<?php

use illuminate\http\request;

/*
|--------------------------------------------------------------------------
| api routes
|--------------------------------------------------------------------------
|
| here is where you can register api routes for your application. these
| routes are loaded by the routeserviceprovider within a group which
| is assigned the "api" middleware group. enjoy building your api!
|
*/

route::middleware('auth:api')->get('/user', function (request $request) {
    return $request->user();
});

route::resource('/nav', 'Api\NavController');
route::resource('/post', 'Api\PostController');

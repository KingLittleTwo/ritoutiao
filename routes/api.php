<?php

use Illuminate\Http\Request;

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
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/cat', 'Api\CategoryController');
Route::resource('/post', 'Api\PostController');

Route::post('/user/signin', 'Api\UserController@signIn');
Route::post('/user/signup', 'Api\UserController@signUp');
Route::post('/user/signout', 'Api\UserController@signOut');

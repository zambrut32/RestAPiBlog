<?php

use Illuminate\Http\Request;

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
Route::post('auth/register','AuthController@register');
Route::post('auth/login','AuthController@login');
Route::get('users','UserController@users');
Route::get('users/profile','UserController@profile')->middleware('auth:api');
Route::post('post','PostController@add')->middleware('auth:api');
Route::get('post','PostController@getMyPost')->middleware('auth:api');
Route::put('post/update/{post}','PostController@update')->middleware('auth:api');
Route::delete('post/delete/{post}','PostController@delete')->middleware('auth:api');
Route::get('post/{id}','PostController@getDetailPost')->middleware('auth:api');
Route::get('post-all','PostController@getAllPost')->middleware('auth:api');
Route::post('comment','CommentController@add')->middleware('auth:api');
Route::post('rating','RatingController@add')->middleware('auth:api');



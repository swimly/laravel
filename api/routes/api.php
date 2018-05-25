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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::group(['middleware'=>['jsonify','web']], function () {
    Route::get('register', 'AuthController@register');
    Route::post('login', 'AuthController@login');
});
Route::group(['middleware'=>['web']], function () {
    Route::get('captcha/{config?}', 'AuthController@captcha');
    Route::get('auth/github', 'GithubController@redirectToProvider');
    Route::get('auth/github/callback', 'GithubController@handleProviderCallback');
});

Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');
Route::group(['middleware' => 'jwt.auth'], function(){
    Route::get('auth/user', 'AuthController@user');
    Route::post('auth/logout', 'AuthController@logout');
    // 文章
    Route::post('auth/article/new', 'ArticleController@create');
    Route::get('auth/articles', 'ArticleController@list');
    // 评论
    Route::post('auth/comment/new', 'CommentController@create');
    Route::get('auth/comments', 'CommentController@list');
});

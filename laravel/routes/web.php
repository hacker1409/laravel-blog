<?php

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

//文章相关
Route::get('/{order?}', 'ArticleController@showList');
//Route::get('list/', 'ArticleController@showList');
Route::get('detail/{id}', 'ArticleController@showDetail');

Route::get('form/show', function () {
    return view('form');
});
Route::post('article/save', 'ArticleController@save');

//评论相关
Route::post('comment/save', 'CommentController@save');
Route::get('comment/ajaxShow/{id?}', 'CommentController@ajaxShow');
Route::get('comment/ajaxByPage/{page?}', 'CommentController@ajaxByPage');

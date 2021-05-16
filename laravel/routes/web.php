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

use App\Http\Controllers\UserController;

Route::get('/', 'IndexController@show');
Route::get('detail/{id}', 'DetailController@show');
Route::get('form/show', function () {
    return view('form', []);
});

Route::post('artitle/save', 'ArtitleController@save');
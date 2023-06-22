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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/blogs','BlogController@index')->name('blogs.index');
Route::get('/blogs/create','BlogController@create')->name('blogs.create');
Route::post('/blogs','BlogController@store');
Route::get('/blogs/{id}/edit','BlogController@edit');
Route::PATCH('/blogs/{id}','BlogController@update')->name('blogs.update');
Route::delete('/blogs/{id}','BlogController@destroy')->name('blogs.destroy');

Route::post('/follower','FollowController@store')->name('follows.store');
Route::delete('/follower{recommended_user}','FollowController@destroy')->name('follows.destroy');

Route::get('/users{recommended_user}', 'UserController@show')->name('users.show');


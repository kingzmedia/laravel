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

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts', 'PostsController@index')->name('posts_index');
Route::get('/posts/{slug}-{id}', 'PostsController@read')->name('posts_view')->where('slug', '[a-z0-9\-_]+')->where('id', '[0-9]+');



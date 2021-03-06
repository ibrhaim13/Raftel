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

//Threads
Route::get('/threads/create','ThreadController@create');
Route::get('/threads','ThreadController@index');
Route::get('/threads/{channel}','ThreadController@index');
Route::post('/threads/create','ThreadController@store');
Route::get('/threads/{channel}/{thread}','ThreadController@show');
Route::delete('/threads/{channel}/{thread}','ThreadController@destroy');

//Reply
//for get replies only to vue pagination
Route::get('/threads/{channel}/{thread}/{replies}','ReplyController@index');
Route::delete('/replies/{reply}','ReplyController@destroy');
Route::patch('/replies/{reply}','ReplyController@update');
Route::post('/threads/{channel}/{thread}/{replies}','ReplyController@store');

//Favirted
 Route::post('/replies/{reply}/favorite','FavoriteController@store');
 Route::delete('/replies/{reply}/favorite','FavoriteController@destroy');

 Route::get('/Profile/{user}','ProfileController@show')->name('profile');
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

// Route::get('/', 'HomeController@index' {
//     return view('blogpost');
// });
Route::get('/', 'postController@blogspost');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/post', 'postController@post')->middleware('auth');
Route::get('/profile', 'profileController@profile')->middleware('auth');
Route::get('/category', 'categoryController@category')->middleware('auth');
Route::post('/addCategory', 'categoryController@addCategory')->middleware('auth');
Route::post('/addProfile', 'profileController@addProfile')->middleware('auth');
Route::post('/addPost', 'postController@addPost')->middleware('auth');
Route::get('/view/{id}', 'postController@view');
Route::get('/delete/{id}', 'postController@delete')->middleware('auth');
Route::get('/edit/{id}', 'postController@edit')->middleware('auth');
Route::post('/editPost/{id}', 'postController@editPost')->middleware('auth');
Route::get('/delete/{id}', 'postController@deletePost')->middleware('auth');
Route::get('/category/{id}', 'postController@category')->middleware('auth');
Route::get('/like/{id}', 'postController@like')->middleware('auth');
Route::get('/dislike/{id}', 'postController@dislike')->middleware('auth');
Route::post('/comment/{id}', 'postController@comment')->middleware('auth');
Route::post('/search', 'postController@search')->middleware('auth');

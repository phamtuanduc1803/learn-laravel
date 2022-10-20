<?php

use Illuminate\Support\Facades\Route;
use App\Like;
use App\Comment;
use App\Post;
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

Route::get('/', 'HomeController@index');


Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');


Route::resource('post', 'PostController');

Route::post('/comment/store', 'CommentController@store')->middleware('auth')->name('comment.store');

Route::get('/like/store/{post}', 'LikeController@store')->name('like.store');
Route::get('/like/update/{like}', 'LikeController@update')->name('like.update');

Route::get('/category/{category}', 'CategoryController@show')->name('category.show');

Route::get('/user/id={id}/profile', 'UserController@pertional')->name('user.profile');
Route::get('/user/profile/edit', 'UserController@edit')->name('user.edit');
Route::patch('/user/profile/update/{id}', 'UserController@update')->name('user.update');

Route::post('/search', 'SearchController@search')->name('search');

Route::post('ckeditor/upload', 'CkeditorController@upload')->name('ckeditor.upload_image');

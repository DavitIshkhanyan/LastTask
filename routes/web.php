<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/w', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/users', 'ProfileController@index')->middleware('auth')->name('all_profiles');
Route::get('/users/profile_edit', 'ProfileController@edit')->middleware('auth')->name('profile.edit');
Route::get('/users/profile_edit/change_password', 'ProfileController@editPassword')->middleware('auth')->name('edit_pass');


Route::get('/users/{username}', 'ProfileController@getProfile')->middleware('auth')->name('profile.index');

Route::put('/users/profile_edit', 'ProfileController@update')->middleware('auth')->name('profile.update');
//Route::get('/users/{username}', 'ProfileController@getProfile')->name('profile.index');
Route::put('/users/profile_edit/change_password', 'ProfileController@changePassword')->middleware('auth')->name('change_pass');

// Friends
Route::get('/friends', 'FriendController@getIndex')->middleware('auth')->name('friend.index');
Route::get('/friends/add/{username}', 'FriendController@getAdd')->middleware('auth')->name('friend.add');
Route::get('/friends/accept/{username}', 'FriendController@getAccept')->middleware('auth')->name('friend.accept');
Route::post('/friends/delete/{username}', 'FriendController@postDelete')->middleware('auth')->name('friend.delete');

// Albums
Route::get('/albums', 'AlbumsController@index')->middleware('auth')->name('albums.index');
Route::get('/albums/create', 'AlbumsController@create')->middleware('auth')->name('albums.create');
Route::put('/albums/store', 'AlbumsController@store')->middleware('auth')->name('albums.store');
Route::get('/albums/{id}', 'AlbumsController@show')->middleware('auth')->name('albums.show');
Route::delete('/albums/{id}','AlbumsController@destroy')->name('albums.destroy');

//Photos
Route::get('/photos/create/{id}', 'PhotosController@create')->middleware('auth')->name('photo.create');
Route::put('/photos/store', 'PhotosController@store')->middleware('auth')->name('photo.store');
Route::delete('/photos/{id}','PhotosController@destroy')->name('photos.destroy');

//Replies(comments)
Route::post('/photos/{id}/reply', 'PhotosController@photoReply')->middleware('auth')->name('photo.reply');
Route::delete('/replies/{id}','PhotosController@destroyReply')->middleware('auth')->name('reply.destroy');

// Likes
Route::get('/photo/{id}/like', 'PhotosController@getLike')->middleware('auth')->name('photo.like');
Route::get('/comment/{id}/like', 'PhotosController@getCommLike')->middleware('auth')->name('comment.like');

// Likes Delete
Route::get('/photo/{id}/destroylike', 'PhotosController@destroyPhotoLike')->middleware('auth')->name('photo.like.destroy');
Route::get('/comment/{id}/destroylike', 'PhotosController@destroyCommLike')->middleware('auth')->name('comment.like.destroy');

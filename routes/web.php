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

Route::get('/home', function () {
    return view('home');
});

Route::get('/', 'App\Http\Controllers\HomeController@create_home')->middleware('login');

//User route
Route::get('/register', 'App\Http\Controllers\Auth\RegisterController@create_register');
Route::post('/create_user', 'App\Http\Controllers\Auth\RegisterController@create_user');
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@create_login');
Route::post('/login_user', 'App\Http\Controllers\Auth\LoginController@login_user');
Route::get('/logout', 'App\Http\Controllers\Auth\LoginController@logout');

//Publication routes
Route::get('/create-publication', 'App\Http\Controllers\publicationController@create_publication')->middleware('login');
Route::get('/my-publication', 'App\Http\Controllers\publicationController@create_my_pub')->middleware('login');
Route::get('/edit-publication/{id}', 'App\Http\Controllers\publicationController@edit_pub')->name('edit-publication')->middleware('login');
Route::get('/update-publication/{id}', 'App\Http\Controllers\publicationController@create_edit_pub')->name('update-publication')->middleware('login');
Route::post('/store_publication', 'App\Http\Controllers\publicationController@store_publication');
Route::post('update_publication/{ig}', 'App\Http\Controllers\publicationController@update_publication')->name('update_publication')->middleware('login');
Route::get('delete-publication/{id}', 'App\Http\Controllers\publicationController@delete_publication')->name('delete-publication')->middleware('login');
Route::get('active-publication/{id}', 'App\Http\Controllers\publicationController@active_publication')->name('active-publication')->middleware('login');

//Auth::routes();
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

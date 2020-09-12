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

Auth::routes();

Route::get('/', 'HomeController@home')->name('home'); //->middleware('auth');

Route::get('/contact', 'HomeController@contact')->name('contact');

// Route::view('/', 'home'); // Does the same as a standard route

//Route::get('/blog-post/{id}/{post?}', 'HomeController@blogPost')->name('blog-post');
Route::resource('/posts', 'PostController'); //->only(['index' 'show']); //->except(['destroy']);

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

Route::get('/', function () {
    return view('home')->name('home');
});

Route::get('/contact', function () {
    return view('contact')->name('contact');
});

// Route::view('/', 'home'); // Does the same as a standard route

Route::get('/blog-post/{id}/{post?}', function($id, $post = 1) {
    $pages = [
      1 => [
        'title' => 'page 1',
      ],
      2 => [
        'title' => 'page 2',
      ],
    ];

    $post = [1 => 'Hello World ', 2 => 'Welcome'];
    return view('blog-post', ['data' => $pages[$id], 'post' => $post[$post]]);
})->name('blog-post');

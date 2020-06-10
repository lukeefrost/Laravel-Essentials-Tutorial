<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function home()
    {
        return view('home');
    }

    public function contact()
    {
        return view('contact');
    }

    public function blogPost($id, $post = 1)
    {
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
    }
}

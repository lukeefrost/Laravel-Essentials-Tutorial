<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\BlogPost;
use App\Http\Requests\StorePost;
// use Illuminate\Support\Facades\DB;


class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /* DB::connection()->enableQueryLog(); // Logs all queries made
        $posts = BlogPost::with('comments')->get(); // Loads comments with blog post ids - Eager loading

        // $posts = BlogPost::all();
        foreach ($posts as $post) {
          foreach ($post->comments as $comment) { // Lazy loading - Making another query inside another one - doesn't fetch comments
            echo $comment->content;
          }
        }

        // dd(DB::getQueryLog()); */

        return view('posts.index', ['posts' => BlogPost::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePost $request)
    {
        //dd($request->all());
        $validatedData = $request->validate();
        $blogPost = new BlogPost::create($validatedData); // Mass assignment helper
        $blogPost->save();

        $request->session()->flash('status', 'Blog post was created successfully');

        return redirect('posts.index'); //redirect()->route('posts.index') -

        //dd($title, $content);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // $request->session()->reflash(); // Keeps the flash variable for the next request
        return view('posts.show', ['post' => BlogPost::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = BlogPost::findOrFail($id);
        return view('posts.edit', ['post' => $post]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StorePost $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $validatedData = $request->validated();

        $post->fill($validatedData);
        $post->save();
        $request->session()->flash('status', 'Blog post was updated');

        return redirect()->route('posts.show', ['post' => $post->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $post = BlogPost::findOrFail($id);
        $post->delete();

        //BlogPost::destroy($id); - Alternative method

        $request->session()->flash('status', 'Blog post deleted successfully');
        return redirect()->route('posts.index');
    }
}

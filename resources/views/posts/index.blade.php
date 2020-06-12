@extends('layout')


@section('content')
  @foreach($posts as $post)
    <p>
      <h3><a href="{{ route('posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a></h3>
      <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit</a>
      <form action="{{ route('posts.destroy', ['post' => $post->id]) }}" method="post" class="fm-inline">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-primary" value="Delete">
      </form>
    </p>
  @endforeach

@endsection

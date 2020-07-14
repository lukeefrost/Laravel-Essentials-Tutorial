@extends('layout')


@section('content')
  <h1>{{ $post->title }}</h1>
  <p>{{ $post->content }}</p>

  <p>Added {{ $post->created_at->diffForHumans()}}</p>

  @if($post->id === 1)
    Post One!
  @elseif($post->id === 2)
    Post Two!
  @else
    Something else
  @endif

  @if ((new Carbon\Carbon())->diffInMinutes($post->created_at) < 5)
    <strong>New!</strong>
  @endif

  <h4>Comments</h4>

  @forelse($post->comments as $comment)
    <p>{{ $comment->content }}</p>
    <p class="text-muted"> added {{ $comment->created_at->diffForHumans()}}</p>
  @empty
    <p>No Comments yet!</p>
  @endforelse


@endsection

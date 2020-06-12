<div class="form-group">
  <label>Title</label>
  <input type="text" name="title" value="{{ old('title', $post->title ?? null) }}" class="form-control">
</div>

<div class="form-group">
  <label>Content</label>
  <input type="text" name="content" value="{{ old('content', $post->content ?? null) }}" class="form-control">
</div>

@if($errors->any())
  <div>
    <ul>
      @foreach($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif

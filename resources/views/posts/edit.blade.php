@extends('layouts.app')

@section('content')
    <h1>Edit Post</h1>
    <form method="post" action="{{ route('posts.update', $post->id) }}" method="POST">
      @method('PUT')
        <div class="form-group">
            @csrf            
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" placeholder="Title" value="{{$post->title}}"/>
        </div>
        <div class="form-group">
            <label for="body">Body</label>
            <textarea class="form-control" name="body" cols="30" rows="10" placeholder="Body Text">{{$post->body}}</textarea>
        </div>

      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
@endsection
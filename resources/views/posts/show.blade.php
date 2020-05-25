@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-default">Go back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {{$post->body}}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <div>
      <hr>
      <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
      
      <form method="POST" action="{{ route('posts.destroy', $post->id) }}" accept-charset="UTF-8" id="deleteForm">
          @method('delete')
          @csrf
          <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger float-right">Delete</button>
      </form>
    </div>

@endsection
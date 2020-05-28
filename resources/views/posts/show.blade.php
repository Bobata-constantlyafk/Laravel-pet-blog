
@extends('layouts.app')



@section('content')
    <a href="/posts" class="btn btn-default">Go back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {{$post->body}}
    </div>

    
    @if($post->image)
    <div class="row">
      <div class="col-12">
        <img id="hover" src="/uploads/pics/{{$post->image}}" alt="" style="width:170px;height:170px"
        onmouseover="this.src='/uploads/pics/{{$post->imagep}}'"  onmouseout="this.src='/uploads/pics/{{$post->image}}'" >
      </div>
    </div>
    @endif

    <hr>

    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <div>
      <hr>
      @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id)
                <a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a>
                
                <form method="POST" action="{{ route('posts.destroy', $post->id) }}" accept-charset="UTF-8" id="deleteForm">
                    @method('delete')
                    @csrf
                    <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger float-right">Delete</button>
                </form>
                </div>
        @endif
      @endif
@endsection

@extends('layouts.app')



@section('content')
    <a href="/posts" class="btn btn-default">Go back</a>
    <div class="row justify-content-center">
    <h1>{{$post->title}}</h1>
    </div>
    <div>
        {{$post->body}}
    </div>


    
    @if($post->image)
    <div class="row">
      <div class="pl-5 col-12" >
        <img class="float-right" id="hover" src="/uploads/pics/{{$post->image}}" alt="" style="width:170px;height:170px"
        onmouseover="this.src='/uploads/pics/{{$post->imagep}}'"  onmouseout="this.src='/uploads/pics/{{$post->image}}'" >
      </div>
    </div>
    @endif

    <hr>

    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <div>
      @if(!Auth::guest())
        @if(Auth::user()->id == $post->user_id || Auth::user()->name == "Admin")
          <a href="/posts/{{$post->id}}/edit" class="btn btn-secondary">Edit</a>
                
            <form method="POST" action="{{ route('posts.destroy', $post->id) }}" accept-charset="UTF-8" id="deleteForm">
              @method('delete')
              @csrf
              <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger float-right">Delete</button>
            </form>
    </div>
      @endif
      @endif



@endsection
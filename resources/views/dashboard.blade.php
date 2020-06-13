@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="p-2 row justify-content-center" >
                        <a href="/posts/create" class="btn btn-primary pr-2">Create Post</a>
                        <form method="GET" class="pl-2" action="/download">
                          @csrf
                          <button type="submit" onclick="return confirm('Are you sure to download?')" class="btn btn-success">Download exl</button>
                        </form>
                    </div>
                        <h5>Your blog posts</h5>
                        @if(count($posts)>0)
                                <table class="table table-striped">
                                    <tr>
                                        <th>Title</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    @foreach($posts as $post)
                                        <tr>
                                            <td>{{$post->title}}</td>
                                            
                                            <td><a href="/posts/{{$post->id}}/edit" class="btn btn-default">Edit</a></td>
                                            <td><form method="POST" action="{{ route('posts.destroy', $post->id) }}" accept-charset="UTF-8" id="deleteForm">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger float-right">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                        @else
                            <p>You have no posts</p>
                        @endif
                  </div>
            </div>
        </div>
    </div>
</div>
@endsection

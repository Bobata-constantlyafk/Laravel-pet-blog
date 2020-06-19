@extends('layouts.app')

@section('content')
    <h1>Edit User</h1>
    <div class="col-sm-3 float-right">
      <img class="profile-image rounded-circle p-1" src="/uploads/avatars/{{$user->avatar}}" alt="Your profile image">
    </div>
    <div class="form-row">
    <form method="post" action="{{ route('addash.update', $user->id) }}" method="POST" enctype="multipart/form-data">
      @method('PUT')
    
        <div class="form-col p-2">
            @csrf            
            <label for="name">Name</label>
            <input type="text" class="form-col" name="name" placeholder="name" value="{{$user->name}}"/>
        </div>
        <div class="form-col p-2">
            <label for="email">Email</label>
            <input class="form-col" name="email" placeholder="email" value="{{$user->email}}"/>
        </div>

        <div class="form-col p-2">
          <input type="file" name="image">
          <div> {{$errors->first('image')}}</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
@endsection
@extends('layouts.app')

@section('stylesheets')
@endsection

<style type="text/css">
.profile-image {
  width:170;
  height: 170;
  background-color: rgba(52,144,220)
}
.change-pic-label{
  font-style: italic;
  color: rgba(0,0,0,0.6)
}
</style>

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-sm-10">

        <div class="row justify-content-center">
          <div class="col-sm-3">
            <img class="profile-image rounded-circle p-1" src="/uploads/avatars/{{$user->avatar}}" alt="Your profile image">
          </div>

          <div class="col-sm-9">
           <h3>
              {{Auth::user()->name}}
              <small class="text-muted"> {{ Auth::user()->email }} </small>
          </h3>

           <hr>
          <form enctype="multipart/form-data" action="/profile" method="POST">
            <label class="change-pic-label">Change picture</label>
            <input type="file" name="avatar">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <input type="submit" class="btn btn-primary">
          </form>
          
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
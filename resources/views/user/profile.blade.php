@extends('layouts.app')

@section('stylesheets')
@endsection

<style type="text/css">
.profile-image {
  width:150;
  background-color: rgba(0,0,0,0.3)
}
</style>

@section('content')
  <div class="container mt-5">
    <div class="row justify-content-center">
      <div class="col-sm-10">

        <div class="row justify-content-center">
          <div class="col-sm-3">
            <img class="profile-image rounded-circle p-2" src="/images/user/default.png" alt="Your profile image">
          </div>

          <div class="col-sm-9">
           <h3>
              {{Auth::user()->name}}
              <small class="text-muted"> {{ Auth::user()->email }} </small>
          </h3>
          The profile page will be extended next week, I promise! For now it just exists...
           <hr>
          </div>

          
        </div>
      </div>
    </div>
  </div>
@endsection
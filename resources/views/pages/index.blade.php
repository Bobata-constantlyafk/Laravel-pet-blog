@extends('layouts.app')

@section('content')
  <div class="jumbotron text-center">
    @guest
    <h1>Welcome to our pet blog</h1>
    <p>This is the blog of Martin and Boyan about pets</p>
    <p><a class="btn btn-primary btn-lg" href="/login" role="button">Login</a> <a class="btn btn-success btn-lg" href="/register" role="button">Register</a></p>
    @endguest
    <h1> M&B Petblog<h1>
  </div>

  <div form-group>
    <div class= "row justify-content-md-center">
  <img  src="/uploads/pics/homepic.jpg" alt="Homepic">
    </div>
  <button class="btn btn-success btn-lg btn-block" href="/dashboard">Dashboard</button>
  <button class="btn btn-primary btn-lg btn-block" href="/profile">Profile</button>
  <button class="btn btn-secondary btn-lg btn-block" href="/posts">Blog</button>
  </div>

@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <h5 class="p-3 row justify-content-center">Manage users</h5>
                        @if(count($users)>0)
                        <table class="table table-striped">
                          <tr>
                              <th>Users:</th>
                              <th></th>
                              <th></th>
                          </tr>
                          @foreach($users as $user)
                          <tr>
                            <td>{{$user->name}}</td>
                          </tr>
                          @endforeach
                        </table>
                        @endif

                  </div>
                 
            </div>
            <div class="p-2 float-right" >
              <form method="GET" class="pl-2" action="/download">
                @csrf
                <button type="submit" onclick="return confirm('Are you sure to download?')" class="btn btn-success">Download users</button>
              </form>
          </div>
        </div>
    </div>
</div>
@endsection

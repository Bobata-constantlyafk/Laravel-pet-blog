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
                            <td><a href="/addash/{{$user->id}}/edit" class="btn btn-default">Edit</a></td>
                                            <td><form method="POST" action="{{ route('addash.destroy', $user->id) }}" accept-charset="UTF-8" id="deleteForm">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" onclick="return confirm('Are you sure to delete?')" class="btn btn-danger float-right">Delete</button>
                                                </form>
                                            </td>
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

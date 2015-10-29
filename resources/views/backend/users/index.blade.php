@extends('master')
@section('title','Admin Panel')

@section('content')
<div class="container col-md-8 col-md-offset-2">
  <div class="panel panel-default">
    <div class="panel-heading">
      <h2>All Users</h2>
    </div>
    @if(session('status'))
      <div class="alert alert-success">
        {{session('statis')}}
      </div>
    @endif
    @if($users->isEmpty())
      <p>There are no users :( </p>
    @else
      <table class="table">
        <thead>
          <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Join Date</th>
          </tr>
        </thead>
        <tbody>
          @foreach($users as $user)
          <tr>
            <td>
              {!! $user->id !!}
            </td>
            <td>
              <a href="#">{!! $user->name !!}</a>
            </td>
            <td>
              {!! $user->email !!}
            </td>
            <td>
              {!! $user->created_at !!}
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
      @endif
  </div>
</div>

@endsection


@extends('layouts.app')
@php
$date_created_at = date("d.m.Y - H:i:s", strtotime($user->created_at));
$date_updated_at = date("d.m.Y - H:i:s", strtotime($user->updated_at));
@endphp

@section('body')
  <div class="container">
    @if (auth()->user()->role == 'admin')
      <a class="btn btn-primary" href="/admin/users">Home - users</a>
    @else
      <a class="btn btn-primary" href="/dashboard">Home</a>
    @endif
    <br><hr><br>
    <h1>User info: {{ $user->name }}</h1>
    <table>
      <body>
        <tr>
          <th>Name: {{ $user->name }}</th>
        </tr>
        <tr>
          <th>Email: {{ $user->email }}</th>
        </tr>
        <tr>
          <th>Password: **************</th>
        </tr>
        <tr>
          <th>Created at: {{ $date_created_at }}</th>
        </tr>
        <tr>
          <th>Updated at: {{ $date_updated_at }}</th>
        </tr>
        <tr>
          <th>Role:<span @if ($user->role == 'guest') style="color: red;"  @endif> {{ $user->role }}</span> </th>
          </tr>
          @if ($user->role == 'guest')
            <tr>
              <th> <strong>For creating posts, you must have "member" role, please contact</strong> <a href="/about"> ADMIN</a>.</th>
            </tr>
          @endif
      </body>
    </table>
    <hr>
    <div class="col-md-7">
      <a class="btn btn-primary" href="{{ $user->id }}/edit">Edit</a>
    </div>
  </div>  
@endsection

@extends('layouts.admin_app')

@section('body')
<h1>User request</h1>

@foreach ($users as $user)
@endforeach




<!-- Search user-->
<div class="row">
  <form action="{{ route('search_user') }}" method="get">
    @csrf
    <input autocomplete="off" class="form-control" name="search" placeholder="Search user...">
  </form>
  <hr>
</div>
<hr>
<a class="btn btn-secondary" href="{{ URL::previous() }}">Back</a>
<a class="btn btn-primary" href="/admin">Home admin</a>
<a class="btn btn-success" href="/user/create">User create</a>
<hr>
@if (count($users) > 0)
<table class="table table-striped">
    <tr>
      <thead>
        <th>id</th>
        <th>User</th>
        <th>Role</th>
        <th></th>
        <th></th>
        <th></th>
        <th></th>
      </thead>
    </tr>

    @foreach ($users_guest as $user)
        <tr>
            <th>{{ $user->id }}</th>
            <th>{{ $user->name }}</th>


            <th><a href="/user/{{ $user->id }}" class="btn btn-primary">Show profile</a></th>
            <th><a href="/admin/show/{{ $user->id }}" class="btn btn-primary">Show posts by user</a></th>
            @if ( $user->role != "admin" )
              <form class="" action="{{ route('edit_role',  $user->id) }}" method="get">
                @csrf
                <input type="text" name="id" value="{{ $user->id }}" hidden>
                <th>
                  <select class="form-control" action="" name="role">
                    <option style="color: red;" name="role" value="{{ $user->role }}">{{ $user->role }}</option>
                    <option value=""></option>
                    <option style="color: red;" name="role" value="guest">guest</option>
                    <option name="role" value="member">member</option>
                    <option name="role" value="admin">admin</option>
                  </select>
                </th>
                <th><button type="submit" class="btn btn-danger">Confirm role</button> </th>
              </form>
              <th><a
                href="{{ route('user.delete', $user->id) }}"
                class="btn btn-danger"
                onclick="return confirm('Are you sure you want to delete this user? \n {{ $user->name }}');">Delete</a>
              </th>

              @else
                <th></th>
                <th></th>
                <th></th>
            @endif
        </tr>
    @endforeach
</table>
{{ $users->links() }}
<hr><br>
@else
  <p>No users</p>
@endif
<hr>

@endsection

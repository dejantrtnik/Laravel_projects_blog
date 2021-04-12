

@extends('layouts.app')


@section('body')

@if($users->isNotEmpty())
@foreach ($users as $user)
    <div class="user-list">
      <h2>{{ $user->name }}</h2>
          <a href="/user/{{ $user->id }}"><p>{{ $user->name }}</p></a>

    </div>
    <br><hr>
@endforeach
@else
<div>
    <h2>No users found</h2>
</div>
@endif
@endsection

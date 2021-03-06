@extends('layouts.admin_app')

@section('body')
<h1>Posts ADMIN dashboard</h1>

@foreach ($posts as $post)
@endforeach
<!-- Search user-->
   <div class="row">
        <form action="{{ route('search_post') }}" method="get">
             <input autocomplete="off" class="form-control" name="search" placeholder="Search post...">
        </form>
        <hr>
   </div>
<hr>
<a class="btn btn-secondary" href="{{ URL::previous() }}">Back</a>
<a class="btn btn-primary" href="/admin">Home admin</a>
<a href="/posts/create" class="btn btn-success">Create post</a>

<hr>
@if (count($posts) > 0)
<table class="table table-striped">
    <tr>
      <thead>
        <th>id</th>
        <th>Title</th>
        <th></th>
        <th></th>
        <th>User name</th>
      </thead>
    </tr>
    @foreach ($posts as $post)
        <tr>
            <th>{{ $post->id }}</th>
            <th><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></th>
            <th><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a></th>
            <th><a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post? \n{{ $post->title }}');">Delete</a></th>

            <th>{{ $post->user->name }}  </th>
        </tr>
    @endforeach
</table>
{{ $posts->links() }}
@else
<p>No post</p>
@endif

<hr>


@endsection

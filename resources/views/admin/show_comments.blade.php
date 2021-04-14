@extends('layouts.app')

@section('body')
  @if (count($posts) > 0)
    @foreach ($posts as $post_user)
    @endforeach
    <h1>Posts by <strong>{{ $post_user->user->name }}</strong></h1>

  @else

  @endif
  <hr>
  <h3>Posts</h3>
  <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
  <hr>
  @if (count($comments) > 0)
    <table class="table table-striped">
      <tr>
        <thead>
          <th>id</th>
          <th>Title</th>
          <th></th>
          <th></th>
        </thead>
      </tr>
      @foreach ($comments as $comment)
        <tr>
          <th>{{ $comment->id }}</th>
          <th><a href="/posts/{{ $comment->id }}">{{ $comment->id }}</a></th>
          <th><a href="/posts/{{ $comment->id }}/edit" class="btn btn-primary">Edit</a></th>
          <th><a href="{{ route('comment.delete', $comment->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post? \n{{ $comment->id }}');">Delete</a></th>

        </tr>
      @endforeach
    </table>
  @else
    <p>No post</p>
  @endif




@endsection

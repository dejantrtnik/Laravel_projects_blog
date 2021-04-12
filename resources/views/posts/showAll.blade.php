@extends('layouts.app')

@section('body')
  @if (count($posts) > 0)
    @foreach ($posts as $post_user)

    @endforeach

  @else

  @endif
  <h1>Posts by <strong>{{ $post_user->user->name }}</strong></h1>
  <hr>
  <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
  <hr>
  @if (count($posts) > 0)
    <table class="table table-striped">
      <tr>
        <thead>
          <th>Post</th>
          <th></th>
          <th></th>
        </thead>
      </tr>
      @foreach ($posts as $post)
        <tr>
          <th><a href="/posts/{{ $post->id }}">{{ $post->title }}</a></th>
          @if (auth()->user()->id == $post->user_id)
            <th><img style="width: 10%;" src="/storage/app/public/cover_images/{{ $post->cover_image }}" alt=""></th>
            <th><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a></th>
            <th><a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post? \n{{ $post->title }}');">Delete</a></th>
          @else
            <th><img style="width: 10%;" src="/storage/app/public/cover_images/{{ $post->cover_image }}" alt=""></th>
          @endif
        </tr>
      @endforeach
    </table>
  @else
    <p>No post</p>
  @endif
@endsection

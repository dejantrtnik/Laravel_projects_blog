@extends('layouts.app')

@section('body')
  <style media="screen">
  img {
    height: 20px;
    width: auto;
  }
  </style>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card">
          <div class="card-header">{{ __('Dashboard') }}</div>
          <div class="card-body">
            @if (session('status'))
              <div class="alert alert-success" role="alert">
                {{ session('status') }}
              </div>
            @endif
            {{ __('You are logged in as ')}} <strong>{{ auth()->user()->name }}</strong>
          </div>
          <div class="card-body">
            <h3>{{ auth()->user()->name }} - Posts</h3>
            @if (count($posts) > 0)
              <table class="table table-striped">
                <tr>
                  <th>id</th>
                  <th>Title</th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
                @foreach ($posts as $post)
                  <tr>
                    <th>{{ $post->id }}</th>
                    <th><a href="posts/{{ $post->id }}">{{ $post->title }}</a></th>
                    <th><img src="/storage/app/public/cover_images/{{ $post->cover_image }}" alt=""></th>
                    <th><a href="/posts/{{ $post->id }}/edit" class="btn btn-primary">Edit</a></th>
                    <th><a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post? \n{{ $post->title }}');">Delete</a></th>
                  </tr>
                @endforeach
              </table>
            @else
              <p>No post</p>
            @endif
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

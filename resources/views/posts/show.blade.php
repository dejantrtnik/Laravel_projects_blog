@extends('layouts.app')
@php
//$date = date("d.m.Y - H:i:s", strtotime($post->created_at));
$date = date("d.m.Y", strtotime($post->created_at));
$counter = 0;
foreach ($comments as $key => $comment) {
  if ($post->id == $comment->id_post) {
    foreach ($users as $key => $user) {
      if ($comment->user_id === $user->id) {
        $counter++;
      }
    }
  }
}
@endphp

@section('body')
  <div class="container">
    <hr>
    <a class="btn btn-primary" href="/posts">Back</a>
    @if (!Auth::guest())
      @if (Auth::user()->id == $post->user_id || auth()->user()->role == 'admin' )
        <a href="{{ route('posts.delete', $post->id) }}" class="btn btn-danger float-right ml-2" onclick="return confirm('Are you sure you want to delete this post? \n{{ $post->title }}');">Delete</a>
        <a class="btn btn-success float-right ml-2" href="/posts/{{ $post->id }}/edit">Edit</a>
      @endif
    @endif
    <hr>
    <h3>{{ $post->title }}</h3>
    <p>{{ $date  }}</p>
    <p>Created by {{ $post->user->name }} <i class="fab fa-calendar-o" aria-hidden="true"></i> </p>
    <a href="/storage/app/public/cover_images/{{ $post->cover_image }}"><img style="width: 40%;" src="/storage/app/public/cover_images/{{ $post->cover_image }}" alt=""></a>
    <p>{!! $post->body !!}</p>
    <br>

  </div>
  <hr>
  <h3>Comments - {{ $counter }}</h3>
  <hr>
  @foreach ($comments as $key => $comment)
    @if ($post->id == $comment->id_post)
      @foreach ($users as $key => $user)
        @if ($comment->user_id === $user->id)
          <h4 style="color: red;">{{ $user->name }}</h4>
          @php
          $date_comment = date("d.m.Y - H:i:s", strtotime($comment->created_at));
          $counter++;
          @endphp
          {{ $date_comment }} <br>
        @endif
      @endforeach
      {!! $comment->comment !!}
      <hr>
    @endif
  @endforeach
  @if (!Auth::guest())
    <div class="container">
      Write comment
      <form class="" method="POST" action="{{ route('posts.show', [$post->id]) }}">
        @csrf
        <!-- id post -->
        <input type="text" class="form-control " name="id_post" value="{{ $post->id }}" required hidden>
        <!-- user_id (post from user) -->
        <input type="text" class="form-control " name="post_user_id" value="{{ $post->user_id }}" required hidden>
        <!-- user id (login user) -->
        <input type="text" class="form-control " name="user_id" value="{{ auth()->user()->id }}" required hidden>
        <textarea id="editor-post"  type="textarea" class="form-control " name="comment" maxlength="10" value="" required></textarea>
        <br>
        <div class="form-group row mb-0">
          <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
              {{ __('Send comment') }}
            </button>
          </div>
        </div>
      </form>
      <br><hr>
      <script src="/vendor/ckeditor/ckeditor/ckeditor.js"></script>
      <script>
        //CKEDITOR.replace( 'editor-post' );
        CKEDITOR.replace('editor-post',{
          wordcount: {
            showCharCount: true,
            maxCharCount: 500
          }
        });
      </script>
    </div>
  @endif
@endsection

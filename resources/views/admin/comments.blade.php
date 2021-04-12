@extends('layouts.admin_app')
<style media="screen">
table, th{
  border-collapse: collapse;
  border: 1px solid black;
  padding: 4px;
}
thead{
  background-color: rgb(195, 165, 95);
}
</style>
@section('body')
  <h1>Comments ADMIN dashboard</h1>
  <hr>
  <a class="btn btn-secondary" href="{{ URL::previous() }}">Back</a>
  <a class="btn btn-primary" href="/admin">Home admin</a>
  <hr>
  @if (count($comments) > 0)
    <h3>All comments: {{ count($comment_count) }}</h3>

  @endif
  @php
  //print_r($posts);
@endphp
{{ $comments->links() }}
<hr>
<table>
  <thead>
    <tr>
      <th>id</th>
      <th>Comment</th>
      <th>Post</th>
      <th>User who comment post</th>
    </tr>
  </thead>
  @foreach ($comments as $key => $comment)
    <tbody>
      <tr>
        <th>{{ $comment->id }}</th>
        <th>{!! $comment->comment !!}</th>
        @foreach ($posts as $key => $post)
          @if ($post->id == $comment->id_post)
            <th><a href="/posts/{{ $comment->id_post  }}">{{ $post->title}}</a></th>
            @foreach ($users as $key => $user)
              @if ($user->id == $comment->user_id)
                <th>{{ $user->name}}</th>
              @endif
            @endforeach
          @endif
        @endforeach
      </tr>

    @endforeach
  </tbody>
</table>


@endsection

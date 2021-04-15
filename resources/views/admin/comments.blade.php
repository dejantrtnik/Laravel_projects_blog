@extends('layouts.admin_app')
<style media="screen">

thead{
  background-color: rgb(147, 209, 244);
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
<table class="table table-striped">
  <thead>
    <tr>
      <th>id</th>
      <th>Comment</th>
      <th>Post</th>
      <th>Comment write</th>
      <th>Post creator</th>
      <th></th>
    </tr>
  </thead>
  @php $j = 0;@endphp
  @foreach ($comments as $key => $comment)
    @php $j++; @endphp
    <tbody>
      <tr>
        <th>{{ $comment->id }}</th>
        <th>
          {!! substr($comment->comment, 0, 50) !!} <br>
          @if (strlen($comment->comment) > 50)
            <a class="" type="button" data-toggle="collapse" data-target="#collapseExample<?= $j ?>" aria-expanded="false" aria-controls="collapseExample">
              Read more
            </a>
          @endif
        </p>
        <div class="collapse" id="collapseExample<?= $j ?>">
          <div class="">
            {!! $comment->comment !!}
          </div>
        </div>
      </th>
      @foreach ($posts as $key => $post)
        @if ($post->id == $comment->id_post)
          <th><a href="/posts/{{ $comment->id_post  }}">{{ $post->title}}</a></th>
          @foreach ($users as $key => $user)
            @if ($user->id == $comment->user_id)
              <th>{{ $user->name}}</th>
              <th>{{ $post->user->name }}</th>
              <th>
                <a
                href="{{ route('comment.delete', $comment->id) }}"
                class=""
                onclick="return confirm('Are you sure you want to delete this post? \n id: {{ $comment->id }} \n from: {{ $comment->user->name }}');"
                >
                <i class="fas fa-trash"></i>
              </a>
            </th>
          @endif
        @endforeach
      @endif
    @endforeach
  </tr>
@endforeach
</tbody>
</table>
@endsection

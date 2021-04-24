@extends('layouts.app')

@section('body')
  @if (auth()->user()->role == 'admin' || auth()->user()->role == 'member')
    <h3>Create</h3>
    {!! Form::open(['action' => 'App\Http\Controllers\PostsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
      {{ Form::label('title', 'Title') }}
      {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
    </div>
    <div class="form-group">
      {{ Form::label('body', 'Body') }}
      {{ Form::textarea('body', '', ['id' => 'editor-post', 'class' => 'form-control', 'placeholder' => 'Some text...']) }}
    </div>
    <div class="form-group">
      {{ Form::file('cover_image') }}
    </div>
    {{ Form::submit('Create post', ['class' => 'btn btn-primary']) }}
    <a class="btn btn-secondary" href="{{ URL::previous() }}">Cancel creating post</a>
    {!! Form::close() !!}
  @else
    <h1>{{ $msg_warning }}</h1>

    <a class="btn btn-primary" href="/about">Contact</a>
  @endif
  <script src="/vendor/ckeditor/ckeditor/ckeditor.js"></script>
  <script>
  CKEDITOR.replace('editor-post',{
    wordcount: {
      showCharCount: true,
      maxCharCount: 10000
    }
  });
  </script>
@endsection

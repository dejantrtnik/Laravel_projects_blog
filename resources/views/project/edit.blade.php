@extends('layouts.app')


@section('body')
  <a class="btn btn-primary" href="{{ URL::previous() }}">Cancel editing</a>
  <br><hr><br>
    <h3>Edit project</h3>

    {!! Form::open(['action' => ['App\Http\Controllers\ProjectController@update', $projects->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
      <div class="form-group">
            {{ Form::label('title', 'Title') }}
            {{ Form::text('title', $projects->title, ['class' => 'form-control', 'placeholder' => 'Title']) }}
      </div>
      <div class="form-group">
            {{ Form::label('topic', 'Topic') }}
            {{ Form::text('topic', $projects->topic, ['class' => 'form-control', 'placeholder' => 'Topic']) }}
      </div>
      <div class="form-group">
            {{ Form::label('body', 'Body') }}
            {{ Form::textarea('body', $projects->body, ['id' => 'editor-post', 'class' => 'form-control', 'placeholder' => 'Some text...']) }}
      </div>
      <div class="form-group">
        {{ Form::file('cover_image') }}
      </div>
      {{ Form::submit('Update project', ['class' => 'btn btn-primary']) }}
      <a class="btn btn-secondary" href="{{ URL::previous() }}">Cancel update project</a>
    {!! Form::close() !!}
    <script src="/vendor/ckeditor/ckeditor/ckeditor.js"></script>
    <script>
      CKEDITOR.replace( 'editor-post' );
    </script>

@endsection

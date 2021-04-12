@extends('layouts.app')


@section('body')
<h1>Create project</h1>

{!! Form::open([ 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
  <div class="form-group">
        {{ Form::label('title', 'Title') }}
        {{ Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title']) }}
  </div>
  <div class="form-group">
        {{ Form::label('topic', 'Topic') }}
        {{ Form::text('topic', '', ['class' => 'form-control', 'placeholder' => 'Topic']) }}
  </div>
  <div class="form-group">
        {{ Form::label('body', 'Body') }}
        {{ Form::textarea('body', '', ['id' => 'editor-post', 'class' => 'form-control', 'placeholder' => 'Some text...']) }}
  </div>
  <div class="form-group">
    {{ Form::file('cover_image') }}
  </div>
  {{ Form::submit('Create project', ['class' => 'btn btn-primary']) }}
  <a class="btn btn-secondary" href="{{ URL::previous() }}">Cancel creating project</a>
{!! Form::close() !!}
<script src="/vendor/ckeditor/ckeditor/ckeditor.js"></script>
<script>
  CKEDITOR.replace( 'editor-post' );
</script>

@endsection

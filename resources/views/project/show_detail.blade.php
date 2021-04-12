@extends('layouts.app')

@section('body')
  <h3>SHOW detail project</h3>

  {{ $projects->title }} <br>
  {{ $projects->topic }} <br>
  {!! $projects->body !!}
  <hr><br>
@endsection

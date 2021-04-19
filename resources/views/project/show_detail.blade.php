@extends('layouts.app')
@php
  $date = date("d.m.Y", strtotime($projects->created_at));
@endphp
@section('body')
  <a class="btn btn-secondary" href="{{ URL::previous() }}">Back</a>
  <hr>
  <h3>{{ $projects->title }}</h3>


  <hr>
  {!! $projects->body !!}
  <hr>
  Created by <strong>( ?? )</strong>  ( {{ $date }} )
  <br><br>
@endsection

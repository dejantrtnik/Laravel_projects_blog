@extends('layouts.app')
@section('body')
  <h1>{{ $title }}</h1>

@if (Auth::user())
  <hr>
  <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
  <a class="btn btn-primary" href="/">Home</a>
  <a class="btn btn-primary" href="/pages/contact/{{ auth()->user()->id }}">Contact</a>
  <hr>
  @else
    <hr>
    <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
    <a class="btn btn-primary" href="/">Home</a>
    <a class="btn btn-primary" href="/pages/contact/guest">Contact</a>
    <hr>
@endif

@php
//echo '<br>';
//print_r($request_url);
@endphp

<div class="col-lg-12">
  <i class="fab fa-facebook-square"></i>
  <i class="fab fa-youtube-square"></i>


  <i class="fab fa-github-square"></i>

</div>

@endsection

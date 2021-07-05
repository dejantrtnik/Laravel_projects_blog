@extends('layouts.app')
@section('body')
  @if (@auth()->user()->id)
    @foreach ($users as $key => $user)
      @if (auth()->user()->id == $user->id)
        <h1>{{ $title }} {{ $user->name }}</h1>
      @endif
    @endforeach
  @else
    <h1>{{ $title }} {{ 'unregistered' }}</h1>
    <strong>Join us for reading posts and creating them</strong> <br>
    <a href="{{ route('login') }}">{{ __('Login') }}</a> or
    <a href="{{ route('register') }}"> {{ __('Register') }}</a>
  @endif

  <hr>
  <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
  <a class="btn btn-primary" href="/">Home</a>
  @if (Auth::user())
    <a class="btn btn-primary" href="/pages/contact/{{ auth()->user()->id }}">Contact</a>
  @else
    <a class="btn btn-primary" href="/pages/contact/guest">Contact</a>
  @endif
  <hr>
  <marquee behavior="scroll" direction="up" style="height:200px;">
    <h5 style="color: red;">Uporaba podatkov na lastno udgovornost</h5>
    <br>
    Uporaba spletne strani je zgolj informativne narave <br>
    in se jo NE uporablja za uradne poizvedbe. <br>
    <br>
    Za kakršnekoli informacije sem na voljo <br>
    na kontaktnem obrazcu <br>

  </marquee>
  <hr>
  <div class="col-lg-12">
    <i class="fab fa-facebook-square"></i>
    <i class="fab fa-youtube-square"></i>
    <i class="fab fa-github-square"></i>

  </div>

@endsection

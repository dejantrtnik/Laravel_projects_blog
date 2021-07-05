@extends('layouts.app')
@php
ini_set('memory_limit', '25M');
@endphp
<style type="text/css">

.jumbotron-billboard .img {
  margin-bottom: 0px;
  opacity: 0.2;
  color: #fff;
  background: #000 url("/storage/app/public/cover_images/map_domzale.png") top center no-repeat;
  width: 100%;
  height: 100%;
  background-size: cover;
  overflow: hidden;
  position:absolute;
  top:0;
  left:0;
  z-index:1;
}
.jumbotron h2 {margin-top:0;}
.jumbotron {
  position:relative;
  padding-top:50px;
  padding-bottom:50px;
}
.jumbotron .container {
  position:relative;
  z-index:2;
}

@media screen and (max-width: 768px) {
  .jumbotron {
    padding-top:20px;
    padding-bottom:20px;
  }
}
</style>

@section('body')
  <style media="screen">
  body {
    background: #e6e6e6;
    margin: 0rem;
  }
  </style>
  <div class="container">
    <div class="jumbotron jumbotron-billboard">
      <div class="img"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <h2>{{ config('app.name') }}</h2>
            <p>
              Webpage build
            </p>
            <a href="/about" class="btn btn-outline-success btn-lg">About</a>
          </div>

          <div class="col-lg-6">
            <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
              <div class="carousel-inner">

                <div class="carousel-item active">
                  Temperature in Domžale
                  <h2>{{ $temp_data_rpi }} °C</h2>
                  <span><a href="/custom/sites/weather">Weather</a></span>
                </div>

                @if (!Auth::guest())
                  <div class="carousel-item">
                    <h4>Live cam</h4>
                    <a href="{{ route('show_video') }}"><img src="{{ photo_ip_cam() }}" width="211" height="120"></a>
                  </div>
                @else
                  <div class="carousel-item">
                    <h4><a href="{{ route('show_video') }}">Live cam</a></h4>
                  </div>
                @endif

                <div style="max-height: 100px; weight: auto;" class="carousel-item">
                  <h5 class="card-title">Measurements in center Domžale</h5>
                  <a href="/custom/sites/weather" class="btn btn-primary">Show data</a>
                </div>

                <div class="carousel-item">
                  <h5 class="card-title">Blog</h5>
                  <a href="/posts" class="btn btn-primary">Blog</a>
                </div>

              </div>
            </div>
          </div>
        </div>
        <br>
        @guest
          @if (Route::has('login'))
            <strong>Join us for reading posts and creating them</strong> <br>
            <a href="{{ route('login') }}">{{ __('Login') }}</a> or
            <a href="{{ route('register') }}"> {{ __('Register') }}</a>
          @endif
        @endguest
      </div>
    </div>
    <hr>
    <div class="container">

      <div class="card">
        <div class="card-header">
          <h3>Last update ( News )</h3>
        </div>
        <div class="card-body">
          <ul>
            <li><a href="{{ route('show_video') }}">Live cam ( test )</a></li>
            <hr>
            <li><a href="/posts">Check out the blog</a>:</li>
            <ul>
              @if (count($posts) > 0)

                <p>Latest posts</p>
                @foreach ($posts as $post)
                  <div class="well">
                    <div class="row">
                      <div class="col-md-6 col-sm-8">
                        <li><a href="/posts/{{$post->id}}">{{ $post->title }} </a></li>
                      </div>
                    </div>
                  </div>
                @endforeach
              @else
                <p>No posts</p>
              @endif
            </ul><hr>
            <li><a href="/project">Projects</a> </li>
            <hr>
            <li>Postavitev osebnega serverja</li>
            <li>Izdelava spletnih strani</li>
            <li>Izdelava modulov ( aplikacij ) za spletno stran</li><br>
            <a href="/about" class="btn btn-primary">Contact</a>
          </ul>
        </div>
      </div>

      <hr>
      <div class="card">
        <div class="card-header">
          <h3>Weather</h3>
        </div>
        <div class="card-body">
          <h5 class="card-title">Measurements in center Domžale</h5>
          <p class="card-text">Showing and collecting some data.</p>
          <ul>
            <li>Air temperature</li>
            <li>Air pressure</li>
          </ul>
          <a href="/custom/sites/weather" class="btn btn-primary">Details</a>
        </div>
      </div>

      <hr>
      <div class="card">
        <div class="card-header">
          <h3>Ip Location</h3>
        </div>
        <div class="card-body">
          <h5 class="card-title">Detailed info about ip address</h5>
          <p class="card-text"></p>
          <ul>
            <li>Your ip address: <span style="color: rgb(68, 187, 57);">{{ Request::server('REMOTE_ADDR') }}</span></li>
            <li>Location</li>
            <li>openMapStreet</li>
          </ul>
          <a href="/custom/sites/iplocation/" class="btn btn-primary">Show detail</a>
        </div>
      </div>

    </div>
    <br>

  @endsection

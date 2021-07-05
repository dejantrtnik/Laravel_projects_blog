@extends('layouts.app')

@section('body')
  <style type="text/css">
  * {
    box-sizing: border-box;
  }

  body {
    background: #e6e6e6;
    margin: 0rem;
  }

  color_white: #fff;
  $color_prime: #5ad67d;
  $color_grey: #e2e2e2;
  $color_grey_dark: #a2a2a2;

  .blog-card {
    display: flex;
    flex-direction: column;
    margin: 1rem auto;
    box-shadow: 0 3px 7px -1px rgba(#000, .1);
    margin-bottom: 1.6%;
    background: $color_white;
    line-height: 1.4;
    font-family: sans-serif;
    border-radius: 5px;
    overflow: hidden;
    z-index: 0;
    a {
      color: inherit;
      &:hover {
        color: $color_prime;
      }
    }
    &:hover {
      .photo {
        transform: scale(1.3) rotate(3deg);
      }
    }
    .meta {
      position: relative;
      z-index: 0;
      height: 200px;
    }
    .photo {
      position: absolute;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background-size: cover;
      background-position: center;
      transition: transform .2s;
    }
    .details,
    .details ul {
      margin: auto;
      padding: 0;
      list-style: none;
    }

    .details {
      position: absolute;
      top: 0;
      bottom: 0;
      left: -100%;
      margin: auto;
      transition: left .2s;
      background: rgba(#000, .6);
      color: $color_white;
      padding: 10px;
      width: 100%;
      font-size: .9rem;
      a {
        text-decoration: dotted underline
      }
      ul li {
        display: inline-block;
      }
      .author:before {
        font-family: FontAwesome;
        margin-right: 10px;
        content: "\f007";
      }

      .date:before {
        font-family: FontAwesome;
        margin-right: 10px;
        content: "\f133";
      }

      .tags {
        ul:before {
          font-family: FontAwesome;
          content: "\f02b";
          margin-right: 10px;
        }
        li {
          margin-right: 2px;
          &:first-child {
            margin-left: -4px;
          }
        }
      }
    }
    .description {
      padding: 1rem;
      background: $color_white;
      position: relative;
      z-index: 1;
      h1,
      h2 {
        font-family: Poppins, sans-serif;
      }
      h1 {
        line-height: 1;
        margin: 0;
        font-size: 1.7rem;
      }
      h2 {
        font-size: 1rem;
        font-weight: 300;
        text-transform: uppercase;
        color: $color_grey_dark;
        margin-top: 5px;
      }
      .read-more {
        text-align: right;
        a {
          color: $color_prime;
          display: inline-block;
          position: relative;
          &:after {
            content: "\f061";
            font-family: FontAwesome;
            margin-left: -10px;
            opacity: 0;
            vertical-align: middle;
            transition: margin .3s, opacity .3s;
          }

          &:hover:after {
            margin-left: 5px;
            opacity: 1;
          }
        }
      }
    }
    p {
      position: relative;
      margin: 1rem 0 0;
      &:first-of-type {
        margin-top: 1.25rem;
        &:before {
          content: "";
          position: absolute;
          height: 5px;
          background: $color_prime;
          width: 35px;
          top: -0.75rem;
          border-radius: 3px;
        }
      }
    }
    &:hover {
      .details {
        left: 0%;
      }
    }

    @media (min-width: 640px) {
      flex-direction: row;
      max-width: 700px;
      .meta {
        flex-basis: 40%;
        height: auto;
      }
      .description {
        flex-basis: 60%;
        &:before {
          transform: skewX(-3deg);
          content: "";
          background: #fff;
          width: 30px;
          position: absolute;
          left: -10px;
          top: 0;
          bottom: 0;
          z-index: -1;
        }
      }
      &.alt {
        flex-direction: row-reverse;
        .description {
          &:before {
            left: inherit;
            right: -10px;
            transform: skew(3deg)
          }
        }
        .details {
          padding-left: 25px;
        }
      }
    }
  }

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
<!-- blog -->
<div class="container">
  <div class="jumbotron jumbotron-billboard">
    <div class="img"></div>
    <div class="container">
      <div class="row">
        <div class="col-lg-4">
          <h2>{{ config('app.name') }}</h2>
          <p>
            We are the best
          </p>
          <a href="/about" class="btn btn-outline-success btn-lg">Read more</a>
        </div>
        <div class="col-lg-8">
          @if (count($posts) > 0)

            <div id="carouselExampleSlidesOnly" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner">
                <?php $i=0; foreach ($posts as $post): ?>
                  <?php if ($i==0) {$set_ = 'active'; } else {$set_ = ''; } ?>
                  <div class='carousel-item <?php echo $set_; ?>'>
                    <a href="posts/{{ $post->id }}"><img style="max-height: 200px; weight: auto;" src='<?= '/storage/app/public/cover_images/'.$post->cover_image ?>' class='d-block w-100'></a>
                  </div>
                  <?php $i++; endforeach ?>
                </div>
              </div>
            </div>
          @else
            No post
          @endif
        </div>
      </div>
    </div>

    <div class="row">
      <div class=" left-column col-lg-7 offset-lg-1 p-1">
        @if (count($posts) > 0)
          <div class="">
            @foreach ($posts as $post)

              <div class="card m-auto p-3">
                <div class="square">
                  <div class="h1">{{ $post->title }}</div>
                  <img style="width: 50%;" src="/storage/app/public/cover_images/{{ $post->cover_image }}" class="mask">
                  <div>
                    <a href="posts/{{ $post->id }}" target="_" class="button"><strong>Read more</strong>
                    </div>
                    <div class="">
                    </a> Created by: {{ $post->user->name }}</div>
                  </div>
                  <div class="square">
                    @php
                      $counter = 0;
                      foreach ( $post_count as $key => $value ) {
                        if ( $post->user_id == $value->user_id ) {
                          $counter++;
                        }
                      }
                    @endphp
                    <span>Posts: <a href="/posts/showAll/{{ $post->user_id }}"><strong>{{ $counter }}</strong></a></span>
                    @foreach ($user as $key => $value)
                      @if ($value->id == $post->user_id)
                        <p>Joined: {{ $date = date("d.m.Y - H:i:s", strtotime($value->created_at)) }}</p>
                      @endif
                    @endforeach
                    @php
                      $counter_comments_by_post = 0;
                      foreach ($comment_count as $key => $comment) {
                        if ($post->id == $comment->id_post) {
                          $counter_comments_by_post++;
                        }
                      }
                    @endphp
                    Comments: {{ $counter_comments_by_post }} <br>
                    @if (Auth::guest())
                      <a href="{{ route('login') }}">{{ __('Login') }}</a> or
                      <a href="{{ route('register') }}"> {{ __('Register') }}</a> to leave a comment

                    @endif
                  </div>
                </div>
                <br><br>
              @endforeach
            </div>
            {{ $posts->links() }}
          @else
            <p>No posts</p>
          @endif
        </div>
        <br><hr>
        <!-- end blog feed -->

        <!-- Right 'create post' column  -->
        <div class="right-column col-lg-3 d-lg-flex d-none flex-column">

          <form class="form-group" action="{{ route('search_post') }}" method="get">
            <input class="form-control" autocomplete="off" class="form-control" name="search" placeholder="Search posts...">
          </form>
          <br>

          <div class="card p-2">
            @if (count($posts) > 0)
              <h4>Last updated posts</h4>
              @foreach ($posts_last_updated as $post)
                <div class="well">
                  <div class="row">
                    <div class="col-md-6 col-sm-8">
                      <p><a href="/posts/{{$post->id}}">{{ $post->title }} </a></p>
                    </div>
                    <hr>
                  </div>
                </div>
              @endforeach
            @else
              <p>No posts</p>
            @endif
          </div>

          <!-- FOR TESTING -->
          <hr>
          <style>
          #video_container {
            margin: 0px auto;
            width: 220px;
            height: 170px;
            /*border: 10px #333 solid;*/
          }
          #videoElement {
            width: 220px;
            height: 170px;
            /*background-color: #666;*/
          }
          </style>
          <div class="card p-2">
            <h4>Live cam</h4>
            {{ $temp_data_rpi }} °C
            <div id="video_container">
              @if (!Auth::guest())

                <a href="{{ route('show_video') }}"><img src="{{ $img }}" width="211" height="120"></a>
              @else
                <strong>Join us for viewing Live CAM</strong> <br>
                <a href="{{ route('login') }}">{{ __('Login') }}</a> or
                <a href="{{ route('register') }}"> {{ __('Register') }}</a>
                <br>
              @endif
              Static image ( refresh every 30 minut - test )
            </div>
          </div><hr>
          <!-- / FOR TESTING -->

          <hr>
          <div class="card p-2">
            <h4>Links:</h4>
            <a href="https://github.com/dejantrtnik"><i class="fab fa-github-square"></i> Github</a>
            <a href="https://www.facebook.com/"><i class="fab fa-facebook-square"></i> Facebook</a>
            <a href="https://www.instagram.com/"><i class="fab fa-instagram-square"></i> Instagram</a>
          </div>

          <hr>
          <div class="card p-2">
            <h4>Home</h4>
            <a href="/custom/sites/weather"><i class="fab fa-weather-square"></i> Weather</a>
            <a href="/custom/sites/iplocation/"><i class="fab fa-location-square"></i> Ip location</a>
          </div>

        </div>
      </div>
    </div>
    <hr><br>
  @endsection

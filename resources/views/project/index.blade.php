@extends('layouts.app')

@section('body')
  <style media="screen">
  body {
    background: #e6e6e6;
    margin: 0rem;

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
@php $j = 0;@endphp
@foreach ($projects as $key => $project)
  @php $j++; @endphp
  <div class="row">
    <div class=" left-column col-lg-10 offset-lg-1 p-1">
      <div class="card">
        <h3 style="color: blue;" class="card-header"><a href="/project/{{ $project->id }}">{{ $project->title }}</a></h3>
        <div class="card-body">
          <h5 class="card-title">{{ $project->topic }}</h5>

          <img style="width: 50%;" src="/storage/app/public/cover_images/{{ $project->cover_image }}" class="mask">
          <hr>
          <a class="btn btn-primary" data-toggle="collapse" href="#collapseExample<?= $j ?>" role="button" aria-expanded="false" aria-controls="collapseExample">
            Read more about - {{ $project->title }}
          </a>
          <hr>
          <div class="collapse" id="collapseExample<?= $j ?>">
            <div class="card card-body">
              {!! $project->body !!}
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
@endforeach
{{ $projects->links() }}
<!-- Right column  -->
<div class="right-column col-lg-2 d-lg-flex d-none flex-column">

</div>
<hr><br>
@endsection

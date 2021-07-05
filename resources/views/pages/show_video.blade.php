@extends('layouts.app')

@section('body')
  <div class="container">

    <h3>Video v živo - LIVE CAM</h3>
    <h5 style="color: red;">
      <strong>!! Zaradi nekaj novih pravil brskalnikov, video še ne deluje !!</strong> <hr>
      <a href="http://www.linijart.eu/video/">Začasna povezava do slike v živo</a> <strong></strong>
    </h5>

    <hr>
    <h6>Temperatura Domžale:<a href="/custom/sites/weather"> <?= rpi() ?> °C</a></h6>
    <hr>
    <img src="{{ $video }}" alt="" id="" width="993" height="558">
    <hr>
    <a href="#"><img src="{{ $img }}" width="211" height="120"></a>
    <br>
    Static image ( refresh every 30 minut )
    <hr>
    <h4>HTTPS težava - se rešuje - ( mix https - http )</h4>
    <ul>
      <li>Firefox - deluje delno - potrebno nekaj nastavitev</li>
      <li>Chrome - deluje delno - potrebno nekaj nastavitev</li>
      <li>Opera - ni testirano</li>
      <li>MS Edge - ni testirano</li>
    </ul>
  </div>
@endsection

@extends('layouts.admin_app')
<style media="screen">
  th{
    padding: 5px;
    border-bottom: 1px solid gray;
  }
</style>

@section('body')
  @foreach ($ip_country as $key => $value_country)
  @endforeach

  <h2>Show detailed: {{ $value_country->country }} - {{ $value_country->ip }}</h2>
  <hr>
  <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
  <a class="btn btn-primary" href="/admin">Home admin</a>
  <hr>
  <table>
    <thead>
      <tr>
        <th>request url</th>
        <th>time visit</th>
      </tr>
    </thead>
@foreach ($ip as $key => $value_ip)
  @php
  $date = date("d.m.Y - H:i:s", strtotime($value_ip->created_at));
  @endphp
  <tbody>
    <tr>
      <th>{{ $value_ip->request_url	 }}</th>
      <th>{{ $date }}</th>
    </tr>
  </tbody>

@endforeach
</table>
  <br><hr><br>

@endsection

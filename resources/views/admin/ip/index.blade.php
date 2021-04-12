@extends('layouts.admin_app')
<style media="screen">
th{
  padding: 5px;
  border-bottom: 1px solid gray;
}
</style>

@section('body')

  <h1>First visit - index</h1>
  <hr>
  <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
  <a class="btn btn-primary" href="/admin">Home admin</a>
  <hr>
  <!-- Search IP BY country-->
  <div class="row">
    <form action="{{ route('search_user') }}" method="get">
      <input autocomplete="off" class="form-control" name="search" placeholder="Search ip by country..">
    </form>
    <hr>
  </div>
  <hr>
  <table>
    <thead>
      <tr>
        <th>id strlen - id</th>
        <th>Country</th>
        <th>ip</th>
        <th>City</th>
        <th>Latutude</th>
        <th>Longitude</th>
        <th>First visit</th>
      </tr>
    </thead>
    @foreach ($ip as $key => $ips)
      @php
      $date = date("d.m.Y - H:i:s", strtotime($ips->created_at));
      @endphp
      <tbody>
        <tr>
          <th><a href="/admin/ip/{{ $ips->ipStrlen }}">{{ $ips->ipStrlen }}</a></th>
          <th>{{ $ips->country }}</th>
          <th>{{ $ips->ip }}</th>
          <th>{{ $ips->city }}</th>
          <th>{{ $ips->latitude }}</th>
          <th>{{ $ips->longitude }}</th>
          <th>{{ $date }}</th>
        </tr>
      </tbody>
    @endforeach
  </table>

  <br><hr><br>
@endsection

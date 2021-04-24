@extends('layouts.admin_app')
<style media="screen">
th{
  padding: 5px;
  border-bottom: 1px solid gray;
}
</style>

@section('body')
  <h2>{{ $title }}</h2>
  <hr>
  <table>
    <thead>
      <tr>
        <th>ip</th>
        <th>date visit</th>
      </tr>
    </thead>
    @foreach ($ip_country as $key => $value)
      @php
        $created_at = date("H:i:s - d.m.Y", strtotime($value->created_at));
      @endphp
      <tbody>
        <tr>
          <th><a href="/admin/ip/{{ $value->ipStrlen }}">{{ $value->ip }}</a></th>
          <th>{{ $created_at }}</th>
        </tr>
      </tbody>
    @endforeach
  </table>


@endsection

@extends('layouts.admin_app')
<style media="screen">
th{
  padding: 5px;
  border-bottom: 1px solid gray;
}
</style>
@section('body')
  @foreach ($users as $key => $user)
    <h3>Detail request url by user: <strong>{{ $user->name }}</strong></h3>
    <hr>
    <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
    <a class="btn btn-primary" href="/admin">Home admin</a>
  @endforeach
  <hr>
  <table>
    <thead>
      <tr>
        <th>request url</th>
        <th>time visit</th>
        <th></th>
        <th></th>
      </tr>
    </thead>
    @php
    @endphp
    @foreach ($request_url as $key => $url)
      @php
      $date = date("d.m.Y - H:i:s", strtotime($url->created_at));
      $ip = \DB::select("SELECT * FROM ip_infos WHERE ipStrlen = '$url->ipStrlen' ");
      @endphp
      <tbody>
        <tr>
          <th>{{ $url->request_url	 }}</th>
          <th>{{ $date }}</th>
          <th></th>
          <th>
            @foreach ($ip as $key => $ips)
              {{ $ips->ip }}
            @endforeach
          </th>
        </tr>
      </tbody>


    @endforeach
  </table>
@endsection

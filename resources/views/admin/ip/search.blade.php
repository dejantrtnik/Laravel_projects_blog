@extends('layouts.admin_app')
@section('body')
  @if($query->isNotEmpty())
    @foreach ($query as  $query_c)
    @endforeach
    
    <h1>Show - detail - {{ $query_c->country }}</h1>
    <hr>
    <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
    <a class="btn btn-primary" href="/admin">Home admin</a>
    <hr>
    <table>
      <thead>
        <tr>
          <th>ip</th>
          <th>date visit</th>
        </tr>
      </thead>
      @foreach ($query as $q)
        <tr>
          <th><a href="/admin/ip/{{ $q->ipStrlen }}">{{ $q->ip }}</a></th>
          <th>{{ $q->created_at }}</th>
        </tr>
      @endforeach
    </table>
  @else
    <div>
      <h2>No ip or country found</h2>
    </div>
    <br><hr>
  @endif
@endsection

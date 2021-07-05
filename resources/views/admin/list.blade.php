@extends('layouts.admin_app')
@section('body')
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            Currently Logged In users: {{ count($devices)  }}
            <a href="{{ count($devices) > 1 ? '/logout/all' : '#' }}" class="btn btn-danger {{ count($devices) == 1 ? 'disabled' : '' }}">Remove all inactive</a>
          </div>
          <table class="table  table-hover">
            <thead class="thead-dark">
              <tr>
                <th>Name</th>
                <th>id - session</th>
                <th>Platform</th>
                <th>Ip address</th>
                <th style="width:12%" >Last Activity</th>
                <th style="width:12%" >Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($devices as $device)
                @php
                  $ipStrlen = post_slug($device->ip_address);
                @endphp
                <tr>
                  @foreach ($users as $key => $user)
                    @if ($user->id == $device->user_id)
                      <td>{{ $user->name }}</td>
                    @endif
                  @endforeach
                  @if ($device->user_id == null)
                    <td style="color: red;">{{ 'inactive' }}</td>
                  @endif
                  <td>{{ $device->id }}</td>
                  <td>{{ $device->user_agent }}</td>
                  <td><a href="/admin/ip/{{ $ipStrlen }}">{{ $device->ip_address }}</a></td>
                  <td>{{ Carbon\Carbon::parse($device->last_activity)->diffForHumans() }}</td>
                  @if ($current_session_id == $device->id)
                    <td><span>Admin user</span></td>
                  @else
                    <td><a href="/logout/{{$device->id}}" class="btn btn-danger">Remove</a></td>
                  @endif
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
@endsection

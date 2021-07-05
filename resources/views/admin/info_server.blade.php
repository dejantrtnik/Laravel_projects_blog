

@extends('layouts.admin_app')
<?php
//header('Content-Type: application/json');
?>
@section('body')
  <h1>Information about server</h1>
  <hr>

  <h3>Server USED disk space:</h3>
  {{ $server['disk_total_num'] -  $server['disk_free_num'] }} GB<br>
  <div class="progress">
    <div class="progress-bar" role="progressbar" style="width: {{ $server['disk_total_num'] -  $server['disk_free_num'] }}%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
  </div><hr>
  <hr>
  
  <h3>Server FREE disk space:</h3>
  {{ $server['disk_free'] }} <br>
  <hr>


  <h3>Server TOTAL disk space:</h3>
  {{ $server['disk_total'] }}
  <hr>

  <h3>Current ip address from which you are accessing:</h3>
  {{ request()->server('REMOTE_ADDR') }}
  <hr>



@endsection

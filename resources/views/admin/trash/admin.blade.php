@extends('layouts.admin_app')
<style media="screen">
  th{
    padding: 5px;
    border-bottom: 1px solid gray;
  }
</style>
<?php
  //$_SESSION['admin_dashboard'] = 'Admin dashboard';
  //$_SESSION['admin_dashboard'];
?>
@section('body')
<h1>Admin dashboard</h1>
<br><hr><br>
@php
  if (count($users_count) > 0) {
    $users = count($users_count);
  }else {
    $users = 'no users';
  }

  if (count($posts_count) > 0) {
    $posts = count($posts_count);
  }else {
    $posts = 'no posts';
  }

  if (count($ip_count) > 0) {
    $ip = count($ip_count);
  }else {
    $ip = 'no ip';
  }

  if (count($ip_unigue_count) > 0) {
    $ip_unigue = count($ip_unigue_count);
  }else {
    $ip_unigue= 'no ip unigue';
  }
@endphp
<div class="container">
  <div class="row">
    <!-- Posts -->
    <div class="col-md-3">
      <h2>Posts</h2>
      <table>
        <thead>
          <tr>
            <th>Page</th>
            <th>Count</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>Posts</th>
            <th>{{ $posts }}</th>
            <th><a href="/admin/posts" class="btn btn-primary">Show</a></th>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- / -->
    <!-- comments -->
    <div class="col-md-3">
      <h2>Blog comments</h2>
      <table>
        <thead>
          <tr>
            <th>Page</th>
            <th>Count</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>Comments</th>
            <th>{{ count($comments) }}</th>
            <th><a href="/admin/comments" class="btn btn-primary">Show</a></th>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- / -->
    <!--  -->
    <div class="col-md-3">
      <h2>Users</h2>
      <table>
        <thead>
          <tr>
            <th>Page</th>
            <th>Count</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>Users</th>
            <th>{{ $users }}</th>
            <th><a href="/admin/users" class="btn btn-primary">Show</a></th>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- / -->
  </div>

  <br><hr><br>
  <!-- Projects -->
  <div class="row">
    <div class="col-md-3">
      <h2>Projects</h2>
      <table>
        <thead>
          <tr>
            <th>Page</th>
            <th>Count</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>Projects</th>
            <th></th>
            <th><a href="/admin/project/" class="btn btn-primary">Show</a></th>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- / -->

  </div>
  <br><hr><br>
  <h2>Visitors</h2>
  <!--  -->
  <div class="row">
    <br>
    <div class="col-md-3">
      <table>
        <thead>
          <tr>
            <th>Page</th>
            <th>Count</th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>

            <th>Unique visitors</th>
            <th>{{ $ip_unigue }}</th>
            <th><a href="/admin/ip" class="btn btn-primary">Show</a></th>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- / -->
    <!--  -->
    <div class="col-md-3">
      <table>
        <thead>
          <tr>
            <th>Graf - all visits</th>
            <th></th>
            <th></th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th>{{ $ip }}</th>
            <th></th>
            <th><a href="/admin/chartjs" class="btn btn-primary">Graph</a></th>
          </tr>
        </tbody>
      </table>
    </div>
    <!-- /  -->
  </div>
</div>



<br><hr><br>

<a href="/posts/create" class="btn btn-success">Create post</a>
<a href="/project/create" class="btn btn-primary">Create project</a>
<a href="/user/create" class="btn btn-danger">Create user</a>

@endsection

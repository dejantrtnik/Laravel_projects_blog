@extends('layouts.admin_app')
<style media="screen">
.body_custom{
  background-color: rgb(163, 175, 165);
}
th{
  padding: 5px;
  border-bottom: 1px solid gray;
}
card{
  background-color: rgb(209, 191, 224);
}
</style>
<?php
//$_SESSION['admin_dashboard'] = 'Admin dashboard';
//$_SESSION['admin_dashboard'];
?>
@section('body')
  @php
  if (count($users_count) > 0) {
    $users = count($users_count);
  }else {
    $users = 'no users';
  }

  if (count($posts_count) > 0) {
    $posts = count($posts_count);
    $last_registered_date = date("H:i:s - d.m.Y", strtotime($last_registered->created_at));
    $last_post_date = date("H:i:s - d.m.Y", strtotime($last_post->created_at));
    if (empty($last_comment->created_at)) {
      $last_comment_date = 'no comment';
    }else {
      $last_comment_date = date("H:i:s - d.m.Y", strtotime($last_comment->created_at));
      // code...
    }
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
<div class="row">
  <div class="col-sm-6">
    <h1>Admin dashboard</h1>
    <small style="color: red;">{{ request()->server('REMOTE_ADDR') }}</small>
    @php
//ini_set('memory_limit', '1024M');

    //print_r(Auth::guard());

    @endphp
  </div>
  <div class="col-sm-6">



    <h1></h1>
  </div>
</div>
<hr>
<div class="container">
  <!-- Statistic -->
  <div class="row">
    <div class="col-sm-3">
      Admins:
      @foreach ($users_admin as $key => $admin)
        <li>
          {{ $admin->name }} <br>
        </li>
      @endforeach
      <hr>
    </div>
    <div class="col-sm-3">
      Last registered Guest:
      @foreach ($users_guest as $key => $guest)
        <li>
          {{ $guest->name }} <br>
        </li>
      @endforeach
      <hr>
      Members roles:
      <li>
        {{ count($users_member) }}
      </li>
      <hr>
      Members registered: <br>
      Posts published: <br>
    </div>
    <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12" style="overflow: scroll; width: 100px; height: 200px;">
          <h5>White list ip:</h5>
          @foreach ($white_list as $key => $list)
            <li>
              {{ $list->ip }}
              <a href="{{ route('ip_white.delete', $list->ip) }}"
                onclick="return confirm('Are you sure you want to delete this post? \n{{ $list->ip }}');">
                <i class="fas fa-trash"></i>
              </a>
            </li>
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <hr>
          <form class="" action="{{ route('white_list') }}" method="post">
            @csrf
            <input type="text" name="white_list_ip" placeholder="add ip to white list..." value="">
          </form>
        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="row">
        <div class="col-sm-12" style="overflow: scroll; width: 100px; height: 200px;">
          <h5>Black list ip:</h5>
          @foreach ($black_list as $key => $list)
            <li>
              {{ $list->ip }}
              <a href="{{ route('ip.delete', $list->ip) }}"
                onclick="return confirm('Are you sure you want to delete this post? \n{{ $list->ip }}');">
                <i class="fas fa-trash"></i>
              </a>
            </li>
          @endforeach
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <hr>
          <form class="" action="{{ route('black_list') }}" method="post">
            @csrf
            <input type="text" name="black_list_ip" placeholder="add ip to black list" value="">
          </form>
        </div>
      </div>
    </div>

  </div>
  <hr>
  <div class="row">
    <div class="card-deck">

      <div class="card p-2" style="width: 20rem;">
        @if (count($users_guest) > 0)
          <a href="/admin/users"><h5 class="card-header text-dark bg-warning border-warning ">Member request</h5></a>
        @else
          <h5 class="card-header text-light bg-dark border-dark ">Member request</h5>
        @endif
        <div class="card-body">
          <h3>{{ count($users_guest) }}</h3>
          <p class="card-text"><small class="text-muted"></small></p>
          Last registered guest:
          {{ count($users_guest) }}
          @foreach ($users_guest as $key => $guest)
            <li>
              {{ $guest->name }} <br>
            </li>
          @endforeach
        </div>
        <a href="/admin/users">show details</a>
        <div class="card-footer bg-transparent border-dark">
          <small>Last registered</small><br>
          Last registered Guest:
          @foreach ($users_guest as $key => $guest)
            <li>
              {{ $guest->name }} <br>
            </li>
          @endforeach
        </div>
      </div>

      <div class="card p-2" style="width: 20rem;">
        <a href="/admin/users"><h5 class="card-header text-white bg-dark border-dark ">Registered</h5></a>
        <div class="card-body">
          <h3>{{ $users - 1 }}</h3>
          <a href="/admin/users">show details</a>
          <p class="card-text">Show all members</p>
          <p class="card-text"><small class="text-muted"></small></p>
        </div>
        <div class="card-footer bg-transparent border-dark">
          <small>Last registered</small><br>
          @if ($posts == 'no posts')
          @else
            <small>{{ $last_registered_date }}</small><br>
            <small>User: {{ $last_registered->name }}</small>
          @endif
        </div>
      </div>

      <div class="card p-2 style="width: 18rem;"">
        <a href="/admin/posts"><h5 class="card-header text-white bg-info border-info">Posts</h5></a>
        <div class="card-body">
          <h3>{{ $posts }}</h3>
          <a href="/admin/posts">show details</a>
          <p class="card-text">Show all post</p>
        </div>
        <div class="card-footer bg-transparent border-info">
          <small>Last created post</small><br>
          @if ($posts == 'no posts')
          @else
            <small>{{ $last_post_date }}</small><br>
            <small>Post: {{ $last_post->title }}</small>
          @endif
        </div>
      </div>

      <div class="card p-2 style="width: 18rem;"">
        <a href="/admin/comments"><h5 class="card-header text-white bg-secondary border-secondary">Comments</h5></a>
        <div class="card-body">
          <h3>{{ count($comments) }}</h3>
          <a href="/admin/comments">show details</a>
          <p class="card-text"><small class="text-muted">Show all comments</small></p>
        </div>
        <div class="card-footer bg-transparent border-secondary">
          <small>Last writted comment</small><br>
          @if ($posts == 'no posts')
          @else
            @if (empty($last_comment->created_at))
            @else
              <small>{{ $last_comment_date }}</small><br>
              <small>Last comment write:<a href="/user/{{ $last_comment->user->id }}">{{ $last_comment->user->name }}</small></a>
            @endif
          @endif
        </div>
      </div>

    </div>
  </div>
  <hr>

  <div class="row">
    <div class="col-sm-3">
      <h2>Visits statistics:</h2>
      <p>
        Some text
      </p>
    </div>

    <div class="card-deck">
      <div class="card p-2" style="width: 20rem;">
        <div class="card-header bg-transparent border-primary">Unique country</div>
        <div class="card-body">
          <h3>{{ count($ip_unigue_count) }}</h3>
          <a href="/admin/ip">show details</a>
          <p class="card-text"><small class="text-muted"></small></p>
        </div>
        <div class="card-footer bg-transparent border-primary"></div>
      </div>
      <div class="card p-2 style="width: 18rem;"">
        <div class="card-header bg-transparent border-primary">All visits</div>
        <div class="card-body">
          <h3>{{ $ip }}</h3>
          <small>Select country</small><br>
          <select name="form" onchange="javascript:handleSelect(this)">
            <option value=""></option>
            @foreach ($countries as $key => $country)
              <option value="/admin/chartjs_country/{{ $country->country }}"><a href="">{{ $country->country }}</a></option>
            @endforeach
          </select> <br><hr>
          <a href="/admin/chartjs">show details</a>
        </div>
        <div class="card-footer bg-transparent border-primary"></div>
      </div>

    </div>
  </div>
  <script type="text/javascript">
    function handleSelect(elm)
    {
      window.location = elm.value;
    }
  </script>
</div>
<hr>
<h3>Registered users per month</h3>
@php
  print_r($users_per_month);
@endphp
<hr>

<canvas id="usersChart" width="300" height="100"></canvas>
<hr>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.0/Chart.min.js"></script>
<script>
  var ctx = document.getElementById('usersChart').getContext('2d');
  var myChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: <?= $months ?>,
      datasets: [{
        label: 'users date register',
        data: <?= $users_per_month ?>,
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(255, 159, 64, 0.2)'
        ],
        borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)',
        'rgba(153, 102, 255, 1)',
        'rgba(255, 159, 64, 1)'
        ],
        borderWidth: 1
      }]
    },
    options: {
      maintainAspectRatio: true,
      responsive: true,
      legend: {
        display: true
      },
      scales: {
        xAxes: [{
          gridLines: {
            display: true
          }
        }],
        yAxes: [{
          gridLines: {
            display: true
          }
        }]
      }
    }
  });
</script>
@endsection

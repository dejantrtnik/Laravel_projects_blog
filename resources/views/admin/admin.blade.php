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
    The current ip from which you are accessing: <small style="color: red;">{{ request()->server('REMOTE_ADDR') }}</small>
  </div>
  <div class="col-sm-6">

    <h1></h1>
  </div>
</div>
<hr>
<div class="container">
  <!-- Statistic -->

  <div class="row">
    <div class="card-deck">

      <div class="card p-2" style="width: 20rem;">
        @if (count($users_guest) > 0)
          <a href="/admin/users"><h5 class="card-header text-dark bg-warning border-warning ">Member request</h5></a>
        @else
          <h5 class="card-header text-light bg-info border-info ">Member request</h5>
        @endif
        <div class="card-body">
          <h3>{{ count($users_guest) }}</h3>
          <a href="/admin/users_req">show request</a>
          <p class="card-text"><small class="text-muted"></small></p>
          Last registered guest:
          @foreach ($users_guest as $key => $guest)
            <li>
              {{ $guest->name }} <br>
            </li>
          @endforeach
        </div>
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
        <a href="/admin/users"><h5 class="card-header text-white bg-info border-info ">Registered users</h5></a>
        <div class="card-body">
          <h3>{{ $users - 1 }}</h3>
          <a href="/admin/users">Show all members</a>
          <p class="card-text"><small class="text-muted"></small></p>
        </div>
        <div class="card-footer bg-transparent border-info">
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
          <a href="/admin/posts">Show all post</a>
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
          <a href="/admin/comments">Show all comments</a>
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
      <div class="card p-2 style="width: 18rem;"">
        <a href="#"><h5 class="card-header text-white bg-secondary border-secondary">Admins</h5></a>
        <div class="card-body">
          @foreach ($users_admin as $key => $admin)
            {{ $admin->name }} <br>
          @endforeach
        </div>
        <div class="card-footer bg-transparent border-secondary">

        </div>
      </div>
    </div>

    <div class="col-sm-3">
      <div class="card p-2 style="width: 18rem;"">
        <a href="#"><h5 class="card-header text-dark bg-white border-dark">White list</h5></a>
        <div class="card-body" style="overflow-y: scroll; height: 100px">
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
        <div class="card-footer bg-transparent border-dark">
          <form class="" action="{{ route('white_list') }}" method="post">
            @csrf
            <input type="text" name="white_list_ip" placeholder="add ip to white list..." value="" maxlength="15">
          </form>

        </div>
      </div>
    </div>
    <div class="col-sm-3">
      <div class="card p-2 style="width: 18rem;"">
        <a href="#"><h5 class="card-header text-white bg-dark border-dark">Black list</h5></a>
        <div class="card-body" style="overflow-y: scroll; height: 100px">
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
        <div class="card-footer bg-transparent border-dark">
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
    // function for selecting country on dropdown
    function handleSelect(elm){
      window.location = elm.value;
    }
  </script>
</div>
<hr>
<h3>Registered users per month</h3>
@php
  //print_r($users_per_month);
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
        label: 'users count register',
        data: <?= $users_per_month ?>,
        backgroundColor: [
        'rgba(255, 99, 132, 0.2)',
        'rgba(54, 162, 235, 0.2)'
        ],
        borderColor: [
        'rgba(255, 99, 132, 1)',
        'rgba(54, 162, 235, 1)'
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

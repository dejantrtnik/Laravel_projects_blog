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


@endphp

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
      <h2>Users statistics: </h2>
      <p>
        Admins:
        @foreach ($users_admin as $key => $admin)
          <li>
            {{ $admin->name }} <br>
          </li>
        @endforeach
        <hr>
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
      </p>
    </div>
    <div class="card-deck">
      <div class="card p-2" style="width: 20rem;">
        <h5 class="card-header text-white bg-dark border-dark ">Members</h5>
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
        <div class="card-header text-white bg-info border-info">Posts</div>
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
        <div class="card-header text-white bg-secondary border-secondary">Comments</div>
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

      <div class="card p-2 style="width: 18rem;"">
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


<?php
//print_r($countryMonthCountJson);
//echo "<pre>";
//$array = array($countryMonthCountJson);
//
$data = [];
$var = json_decode($countryMonthCountJson);
$j = 0;
$i = 0;
//$person = json_decode($countryMonthCountJson);

//echo $person->country;

//while ($i <= $j) {
//  $i + 1;
//  $j + 1;
//
//  //print_r($i);
//}





//echo $var[1]->country;
//echo $array;
//echo "<br>";
//echo preg_replace('/[^a-z0-9"",_]/i', '', str_replace('country', '', $countryMonthCountJson));
 //preg_replace("/[^a-z0-9_]/i", '', 'New_text % *');
//foreach ($countryMonthCountJson as $value) {
//  //$value = [];
//  //echo json_encode($value->country);
//  //print_r($value);
//}

//array_push($data, array('country' => $var[0]->country));

//print_r($data);
?>
<?php foreach ($var as $key => $value) {echo '""'.$value->country. '""';}?>

<canvas id="countryChart" ></canvas>
<canvas id="usersChart" width="300" height="100"></canvas>
<hr>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.0/Chart.min.js"></script>
<script>
var ctx = document.getElementById("countryChart");
var myChart = new Chart(ctx, {
  type: 'pie',
  data: {
    labels: [
    ],
    datasets: [{
      label: '# of Tomatoes',
      data: <?= $users_per_month ?>,
      backgroundColor: [
        'rgba(255, 99, 132, 0.5)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(255, 206, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)'
      ],
      borderColor: [
        'rgba(255,99,132,1)',
        'rgba(54, 162, 235, 1)',
        'rgba(255, 206, 86, 1)',
        'rgba(75, 192, 192, 1)'
      ],
      borderWidth: 1
    }]
  },
  options: {
   	//cutoutPercentage: 40,
    responsive: false,

  }
});
</script>
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

@extends('layouts.admin_app')

@section('body')

  @php
  //dd($monthCountJson);
  //print_r($dataVisitors);
  @endphp



  <h1>Graf - chart - {{ $search_country }}</h1>



  <hr>
  <a class="btn btn-secondary" href="{{ URL::previous() }}">Back</a>
  <a class="btn btn-primary" href="/admin">Home admin</a>
  <hr>
  <div class="container">
    <div class="row">
      <div class="col-md-10 offset-md-1">
        <div class="panel panel-default">
          <div class="panel-heading">Dashboard</div>
          <div class="panel-body">
            <canvas id="visitChart" height="280" width="600"></canvas>
          </div>
        </div>
      </div>

      <div class="col-md-10 offset-md-2">
        <div class="panel panel-default">
          <div class="panel-heading">Dashboard</div>

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
        </div>
      </div>

    </div>
  </div>
  <hr><br>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.0/Chart.min.js"></script>

  <script type="text/javascript">
  var visitChartCanvas = $('#visitChart').get(0).getContext('2d')
  var visitChartData = {
    labels: <?= $months ?>,
    datasets: JSON.parse('<?= $dataVisitors ?>')
  }
  console.log(visitChartData)
  var visitChartOptions = {
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
  var visitChart = new Chart(visitChartCanvas, {
    type: 'line',
    data: visitChartData,
    options: visitChartOptions
  })
</script>
@endsection

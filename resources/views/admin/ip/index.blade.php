@extends('layouts.admin_app')
<style media="screen">
th{
  padding: 5px;
  border-bottom: 1px solid gray;
  text-align: center;
  align-items: center;
}
form{
  text-align: center;
  align-items: center;
}
</style>


@section('body')
  <body>
    <h1>First visit</h1>
    <hr>
    <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
    <a class="btn btn-primary" href="/admin">Home admin</a>
    <hr>
    <!-- Search IP BY country-->
    <div class="row">
      <form action="{{ route('search_ip') }}" method="get">
        <input autocomplete="off" class="form-control" name="search" placeholder="Search ip by country..">
      </form>
      <hr>
    </div>
    <hr>
    <table>
      <thead>
        <tr>
          <th>id strlen - id</th>
          <th>Country</th>
          <th>ip</th>
          <th>City</th>
          <th>Latutude</th>
          <th>Longitude</th>
          <th>First visit</th>
          <th>White list</th>
          <th></th>
          <th>Black list</th>
          <th></th>
        </tr>
      </thead>
      @foreach ($ip as $key => $ips)
        @php
        $query_black_list = DB::table('black_list')->where('ip', $ips->ip)->get();
        $query_white_list = DB::table('white_list')->where('ip', $ips->ip)->get();
        $date = date("d.m.Y - H:i:s", strtotime($ips->created_at));
      @endphp
      <tbody>
        <tr>
          <th><a href="/admin/ip/{{ $ips->ipStrlen }}">{{ $ips->ipStrlen }}</a></th>
          <th><a href="/admin/ip/country/{{ $ips->country }}">{{ $ips->country }}</a></th>
          <th>{{ $ips->ip }}</th>
          <th>{{ $ips->city }}</th>
          <th>{{ $ips->latitude }}</th>
          <th>{{ $ips->longitude }}</th>
          <th>{{ $date }}</th>
          <th>
            <form class="" action="{{ route('white_list') }}" method="post">
              @csrf
              <input type="text" name="white_list_ip" value="{{ $ips->ip }}" hidden>
              <button type="submit" class="fas fa-database" style="color: green;" name="button"></button>
            </form>
          </th>
          <th style="color: green;">
            @foreach ($query_white_list as $key => $value)
              @if ($key == 0)
                {{ 'allowed' }}
              @endif
            @endforeach
          </th>
          <th>
            <form class="" action="{{ route('black_list') }}" method="post" onchange='this.form.submit()'>
              @csrf
              <input type="text" name="black_list_ip" value="{{ $ips->ip }}" hidden>
              <button type="submit" class="fas fa-database" style="color: red;" name="button"></button>
            </form>
          </th>
          <th style="color: red;">
            @foreach ($query_black_list as $key => $value)
              @if ($key == 0)
                {{ 'blocked' }}
              @endif
            @endforeach
          </th>

        </tr>
      </tbody>
    @endforeach
  </table>

  <br><hr><br>

</body>

<script type="text/javascript">
  ;(function($){

    /**
    * Store scroll position for and set it after reload
    *
    * @return {boolean} [loacalStorage is available]
    */
    $.fn.scrollPosReaload = function(){
      if (localStorage) {
        var posReader = localStorage["posStorage"];
        if (posReader) {
          $(window).scrollTop(posReader);
          localStorage.removeItem("posStorage");
        }
        $(this).click(function(e) {
          localStorage["posStorage"] = $(window).scrollTop();
        });

        return true;
      }

      return false;
    }
    /* ================================================== */
    $(document).ready(function() {
      // Feel free to set it for any element who trigger the reload
      $('form').scrollPosReaload();
    });
  }(jQuery));
</script>

@endsection

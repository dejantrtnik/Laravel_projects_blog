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
        </tr>
      </thead>
      @foreach ($ip as $key => $ips)
        @php
        $query_black_list = DB::table('black_list')->where('ip', $ips->ip)->get();
        $query_white_list = DB::table('white_list')->where('ip', $ips->ip)->get();
        $date = date("d.m.Y - H:i:s", strtotime($ips->created_at));
        // temporary solution
        $white_list = \DB::select("SELECT * FROM white_list WHERE ip = '$ips->ip'");
        $black_list = \DB::select("SELECT * FROM black_list WHERE ip = '$ips->ip'");
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
            <th style="color: green;">
              @if (empty($white_list))
                <th>
                  <form class="" action="{{ route('white_list') }}" method="post">
                    @csrf
                    <input type="text" name="white_list_ip" value="{{ $ips->ip }}" hidden>
                    <button type="submit" class="fas fa-wifi" style="color: green;" name="button"></button>
                  </form>
                </th>
              @else
                <th>
                  not count
                  <a class="fas fa-trash" href="{{ route('ip_white.delete', $ips->ip) }}"
                    onclick="return confirm('Are you sure you want to delete this post? \n{{ $ips->ip }}');">
                  </a>
                </th>
              @endif
            </th>
            <th style="color: red;">
              @if (empty($black_list) && empty($white_list))
                <th>
                  <form class="" action="{{ route('black_list') }}" method="post" onchange='this.form.submit()'>
                    @csrf
                    <input type="text" name="black_list_ip" value="{{ $ips->ip }}" hidden>
                    <button type="submit" class="fas fa-database" style="color: red;" name="button"></button>
                  </form>
                </th>
              @else
                @foreach ($query_black_list as $key => $value)
                  @if ($key == 0)

                    {{ 'blocked' }}
                    <a class="fas fa-trash" href="{{ route('ip.delete', $value->ip) }}"
                      onclick="return confirm('Are you sure you want to delete this post? \n{{ $value->ip }}');">
                    </a>
                  @endif
                @endforeach
              @endif
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

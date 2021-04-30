@extends('layouts.admin_app')
<style media="screen">
th{
  padding: 5px;
  border-bottom: 1px solid gray;
}
</style>

@section('body')
  <h2>{{ $title }}</h2>
  <hr>
  <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
  <a class="btn btn-primary" href="/admin">Home admin</a>
  <hr>
  <table>
    <thead>
      <tr>
        <th>ip</th>
        <th>date visit</th>
        <th>White list</th>
        <th></th>
        <th>Black list</th>
        <th></th>
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
          <th>
            <form class="" action="{{ route('white_list') }}" method="post">
              @csrf
              <input type="text" name="white_list_ip" value="{{ $value->ip }}" hidden>
              <button type="submit" class="fas fa-database" style="color: green;" name="button"></button>
            </form>
          </th>
          <th style="color: green;">
            @foreach ($query_white_list as $key => $val)
              @if ($val->ip == $value->ip)
                {{ 'allowed' }}
              @endif
            @endforeach
          </th>
          <th>
            <form class="" action="{{ route('black_list') }}" method="post" onchange='this.form.submit()'>
              @csrf
              <input type="text" name="black_list_ip" value="{{ $value->ip }}" hidden>
              <button type="submit" class="fas fa-database" style="color: red;" name="button"></button>
            </form>
          </th>
          <th style="color: red;">
            @foreach ($query_black_list as $key => $val)

              @if ($val->ip == $value->ip)
                {{ 'blocked' }}
              @endif
            @endforeach
          </th>
        </tr>
      </tbody>
    @endforeach
  </table>
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

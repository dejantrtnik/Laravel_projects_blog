@extends('layouts.admin_app')

@section('body')
  <h1>User login details</h1>

  <br>
  <div class="form-group">
    <label for="">Select user</label>
    <select class="form-control" onchange="javascript:handleSelect(this)">
      <option value=""></option>
      @foreach ($user_login as $key => $user_log)
        <option value="/admin/user_login/{{ $user_log->user_id }}">{{ $user_log->user->name }}</option>
      @endforeach
    </select>

  </div>
  <br>
  @if (!empty($user_details))
    <div class="container">
      @foreach ($users as $key => $user)
        <h3>{{ $user->name }}</h3>
      @endforeach
      <hr>
      <div class="row">
        @foreach ($user_details as $key => $user_detail)
          @php
          $created_at = date("H:i:s - d.m.Y", strtotime($user_detail->created_at));
          @endphp
          {{ $created_at }} <br>
        @endforeach

      </div>
      <hr>
      {{ $user_details->links() }}
    </div>
  @endif

  <script type="text/javascript">
  // function for selecting "item" and "submiting" on dropdown
  function handleSelect(elm){
    window.location = elm.value;
  }
  </script>
@endsection

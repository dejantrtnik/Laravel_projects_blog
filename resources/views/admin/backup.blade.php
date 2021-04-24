@extends('layouts.admin_app')

@section('body')
  <h1>backup</h1>

  <form class="" action="{{ route('backup_store' , 'name') }}" method="get">
    @csrf
    <select class="" name="option">
      <option value="1">1</option>
      <option value="2">2</option>
    </select>
    <input type="text" name="var" value="">
    <button type="submit" name="button">Submit</button>
  </form>
@endsection

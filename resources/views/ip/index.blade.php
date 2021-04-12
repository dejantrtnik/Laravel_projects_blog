@extends('layouts.app')
@php
    ini_set('memory_limit', '25M');


@endphp
@section('body')
     <h1></h1>


@php
    //print_r(session());
//
    //print_r(session()->get('ip'));
    //print_r(request()->server('SERVER_ADDR'));
    echo '<pre>';
@endphp

{{ $request }}
@endsection

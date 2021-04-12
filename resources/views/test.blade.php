@extends('layouts.app')
@php
    ini_set('memory_limit', '25M');


@endphp
@section('body')
     <h1></h1>
@php
    $ip = '193.77.83.59';
    //$ip = $_SERVER['REMOTE_ADDR'];
    //$pages = new PagesController('193.77.83.59');
    echo '<pre>';
    print_r($data);

    //print_r(Request::server('SERVER_ADDR'));

@endphp




@php
    //print_r(session()->get('ip'));

    //print_r(request()->server('SERVER_ADDR'));
@endphp



@endsection

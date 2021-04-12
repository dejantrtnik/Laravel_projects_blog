@extends('layouts.app')

@section('body')
     <h1>{{ $title }}</h1>
     <div class="container">
          <div class="row">
               <div class="col-md-7">
                    <a class="btn btn-primary" href="user/{{ auth()->user()->id }}/edit">Edit</a>
               </div>
          </div>
     </div>
@endsection

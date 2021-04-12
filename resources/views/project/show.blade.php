@extends('layouts.admin_app')

@section('body')
  <h3>{{ $title }}</h3>
  <div class="container">
    @if (auth()->user()->role == 'admin')

      <hr>
      <a class="btn btn-secondary" href="{{ URL::previous() }}">Back</a>
      <a class="btn btn-primary" href="/admin">Home admin</a>
      <a class="btn btn-success" href="/project/create">Create project</a>
      <hr>
      @if (count($projects) > 0)
        <table class="table table-striped">
          <tr>
            <thead>
              <th>id</th>
              <th>Title</th>
              <th></th>
              <th></th>
            </thead>
          </tr>
          @foreach ($projects as $project)
            <tr>
              <th>{{ $project->id }}</th>
              <th><a href="/project/{{ $project->id }}">{{ $project->title }}</a></th>
              <th><a href="/admin/project/{{ $project->id }}/edit" class="btn btn-primary">Edit</a></th>
              <th><a href="{{ route('project.delete', $project->id) }}" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this project? \n{{ $project->title }}');">Delete</a></th>
            </tr>
          @endforeach
        </table>
      @else
        <p>No projects</p>
      @endif
    @else

    @endif


    <hr><br>
  @endsection

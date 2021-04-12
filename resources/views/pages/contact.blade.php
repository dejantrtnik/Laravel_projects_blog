@extends('layouts.app')

@section('body')
  <h1>{{ $title }}</h1>
  <hr>
  <a class="btn btn-primary" href="{{ URL::previous() }}">Back</a>
  <a class="btn btn-primary" href="/">Home</a>
  <hr>

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">

        <div class="card">
          <div class="card-header">{{ __('Send us question') }}</div>
          <div class="card-body">
            <form method="POST" action="{{ route('telegram') }}">
              @csrf
              <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>
                <div class="col-md-6">
                  <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="@if (Auth::user()){{ $user->name }} @endif" @if (Auth::user()) readonly @endif required autocomplete="name" autofocus>
                    @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>
                  <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="@if (Auth::user()){{ $user->email }}@endif" @if (Auth::user()) readonly @endif required autocomplete="email">
                      @error('email')
                        <span class="invalid-feedback" role="alert">
                          <strong>{{ $message }}</strong>
                        </span>
                      @enderror
                    </div>
                  </div>

                  @if (Auth::guest())
                    <input id="subject" type="text" class="form-control" name="subject" value="No registered user" required hidden>                       
                  @else
                    <div class="form-group row">
                      <label for="subject" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>
                      <div class="col-md-6">
                        <select class="form-control" name="subject" required>
                          <option value="Post write approval">Post write approval</option>
                          <option value="Issue">Issue</option>
                          <option value="I have cool idea">I have cool idea</option>
                          <option value="Something else">Something else</option>
                        </select>
                      </div>
                    </div>
                  @endif

                  <div class="form-group row">
                    <label for="body" class="col-md-4 col-form-label text-md-right">{{ __('Message') }}</label>
                    <div class="col-md-6">
                      <textarea rows="8" cols="80" id="body" type="text" class="form-control @error('body') is-invalid @enderror" name="body" value="@if (Auth::user()){{ $user->name }} @endif" required autocomplete="name" autofocus></textarea>
                        @error('body')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                        @enderror
                      </div>
                    </div>


                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                          {{ __('Send message') }}
                        </button>
                        <a class="btn btn-secondary" href="{{ URL::previous() }}">Cancel</a>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>

      @endsection

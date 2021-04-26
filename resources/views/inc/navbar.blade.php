<nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm navbar-static-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/"><img style="max-height: 25px; weight: auto;" src="/storage/app/public/static_images/sidebar.png" alt=""> {{ config('app.name') }}</a>


  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" href="/">Home <span class="sr-only"></span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/posts">Blog</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/project">Project</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/about">About</a>
      </li>
    </ul>

    <!-- Right Side Of Navbar -->
    <ul class="navbar-nav ml-auto">
      <!-- Authentication Links -->
      @guest
        @if (Route::has('login'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
        @endif

        @if (Route::has('register'))
          <li class="nav-item">
            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
          </li>
        @endif
      @else

        <li class="nav-item dropdown">
          <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }}
          </a>



          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
            @if (auth()->user()->role == 'admin')
              <a class="dropdown-item" href="/admin">Admin dashboard</a><hr>
              <a class="dropdown-item" href="/"><i class="fas fa-home"></i> Home</a><hr>
            @else
              <a class="dropdown-item" href="/"><i class="fas fa-home"></i> Home</a>
              <hr>
            @endif
            <a class="dropdown-item" href="/dashboard"><i class="fas fa-list"></i> Dashboard</a>
            <a class="dropdown-item" href="/posts/create"><i class="far fa-plus-square"></i> Create post</a>

            <a class="dropdown-item" href="/user/{{ auth()->user()->id }}"><i class="fas fa-cogs"></i> User settings</a>
            <hr>
            <a style="color: red;" class="dropdown-item" href="{{ route('logout') }}"
            onclick="event.preventDefault();
            document.getElementById('logout-form').submit();"><i class="fas fa-sign-out-alt"></i>
            {{ __('Logout') }}
          </a>
          <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
          </form>

        </div>
      </li>
    @endguest
  </ul>
</div>
</nav>

<script>
  $(function($) {
    let url = window.location.href;
    $('li a').each(function() {
      if (this.href === url) {
        $(this).closest('li').addClass('active');
      }
      console.log(url);
    });
  });
</script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#myModal').modal('show');
  });
</script>
<script>
  function goBack() {
    window.history.back();
  }
</script>

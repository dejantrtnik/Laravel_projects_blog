<nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm navbar-static-top">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="/admin"><img style="max-height: 25px; weight: auto;" src="/storage/app/public/static_images/logo_server_black.png" alt=""> Admin dashboard</a>




  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">


      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Posts
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/posts/create">Create post</a>
          <a class="dropdown-item" href="/admin/posts">Posts</a>
          <a class="dropdown-item" href="/admin/comments">Blog comments</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Projects
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/project/create/">Create project</a>
          <a class="dropdown-item" href="/admin/project/">Projects</a>
        </div>
      </li>

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Visitors
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="/admin/ip">Unique visitors</a>
          <a class="dropdown-item" href="/admin/chartjs">Graf - all visits</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#"> </a>
      </li>
      <!--
      <li class="nav-item">
      <a class="nav-link" href="#"><i class="fa fa-comment"></i></a>
    </li>
  -->
  <li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      Users settings
    </a>
    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
      <a class="dropdown-item" href="/user/create">Create user</a>
      <a class="dropdown-item" href="/admin/users">Users</a>
      <a class="dropdown-item" href="/admin/user_login">Users login detail</a>

    </div>
  </li>


</ul>
</div>

<a href="{{ route('show_video') }}" class="btn btn-primary">Live cam</a>
<li class="navbar-nav justify-content-center"><br> </li>
<li class="navbar-nav justify-content-center">
  {{ session('count_logged_users') }}
  @php
    // temporary solution
    $session_count = \DB::select("SELECT * FROM sessions WHERE user_id IS NOT NULL");
  @endphp
  @if (count($session_count) > 1)
    <a class="nav-link" href="/admin/logged_in_devices">Active sessions</a>
    <span class="nav-link"><strong style="color: yellow;">{{ count($session_count) - 1 }}</strong></span>
  @else
    <a class="nav-link" href="/admin/logged_in_devices">Active sessions</a>
  @endif
</li>
<div class="collapse navbar-collapse" id="navbarNav">
  <!-- Right Side Of Navbar -->
  <ul class="navbar-nav ml-auto" id="navbarNav">
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
            <a class="dropdown-item" href="/"><i class="fas fa-home"></i> Home</a>
            <hr>
            <a class="dropdown-item" href="/admin">Admin dashboard</a>
          @else

          @endif
          <a class="dropdown-item" href="/dashboard">User dashboard</a>
          @if (auth()->user()->role == 'admin')
            <a class="dropdown-item" href="/admin/info_server">Info server</a>
            <hr>
            <a class="dropdown-item" href="/admin/backup"><i class="fas fa-hdd"></i> BACKUP</a>
          @endif
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

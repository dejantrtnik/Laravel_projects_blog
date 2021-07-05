<?php $jsonUser = json_decode(file_get_contents('../../inc/user/user.json'), true); ?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="description" content="">
<meta name="viewport" content="width=device-width, initial-scale=1">

<script type="text/javascript" src="./assets/js/jquery.min.js"></script>
<script type="text/javascript" src="./assets/js/Chart.min.js"></script>
<link rel="stylesheet" href="./assets/css/bootstrap.css">
<link rel="stylesheet" href="./assets/css/bootstrap.min.css">
<script type="text/javascript" src="./assets/js/bootstrap.min.js"></script>
<link rel="shortcut icon" type="image/gif/png" href="../img/logo_server_black_small.png">

<nav class="navbar navbar-expand-lg navbar navbar-dark bg-dark">
  <a class="navbar-brand" href="#">Meritve</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarText">
    <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
            <li class="nav-item">
        <a class="nav-link" href="/">Webproject</a>
      </li>
        <li class="nav-item active">
            <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#opisModal" href="#">Opis meritve</a>
      </li>
        <li class="nav-item active">
            <li class="nav-item">
        <a class="nav-link" data-toggle="modal" data-target="#pogojiModal" href="#">Pogoji</a>
      </li>
    </ul>
  </div>
</nav>

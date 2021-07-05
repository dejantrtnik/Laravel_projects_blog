<?php
namespace root;

class Modules{
  static function basic(){
    require "./Modules/dotEnv/dotEnv.php";
    require "./Modules/database/conn.php";
    require "./Modules/telegram/telegram.php";
    require "./Modules/ip/ip.php";
  }
}

class BootStyle{
  static function basic(){
    require 'apps/bootStyle/const/Bootstrap/css_js_jquery.php';
    require 'apps/bootStyle/const/links/links.php';
    require 'apps/bootStyle/const/own/personal.php';
  }
}

class Sites{
  static function sites(){
    include "./sites/index.php";
  }
}


?>


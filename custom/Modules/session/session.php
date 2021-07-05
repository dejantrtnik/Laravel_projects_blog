<?php
defined('BASEPATH') or exit('No direct script access allowed');
function sessionActive($session)
{
  if (!isset($_SESSION['id'])){
    die('403');
    //header('Location: index.php');
    //exit();
  }

  if ($_SESSION['id'] == $session){
  	//define('BASEPATH', true);
    echo "string";
    echo "<br>";
  }else {
    die('403');
  }
}


?>

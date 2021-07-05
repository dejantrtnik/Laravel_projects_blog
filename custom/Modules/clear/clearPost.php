<?php
// clear post
function clearPost(){
  if (!isset($_SESSION)){
    session_start();
  }
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $_SESSION['form'] = $_POST;
    unset($_POST);
    header("Location: ".$_SERVER[REQUEST_URI]);
    exit;
  }
  if (@$_SESSION['form']){
    $_POST = $_SESSION['form'];
    unset($_SESSION['form']);
  }
}
?>

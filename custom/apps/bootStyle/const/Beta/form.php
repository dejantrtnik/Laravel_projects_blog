<?php

function form($array, $classForm, $classInput, $php){
  echo '<form class="' . $classForm . '" action="' . $php . '" method="post"> <br>';
  foreach ($array as $value) {
    for ($i=0; $i < count($value); $i++) {
      if (($i - 1) % 2) {
        $label = $value[$i];
        echo '<label for="">' . $label . '</label> <br>';
      }elseif ($i % 2){
        $name = $value[$i];
        echo '<input class="' . $classInput . '" type="text" name="' . $name . '" value=""> <br><br>';
      }
    }
    echo '<input type="submit" name="form" value="Submit"> <br>';
    echo '</form>';
  }
  return $_POST["*"];
}
?>

<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Env
{
  function __construct(string $filePath){
    if (file_exists($filePath)) {
      $this->path = $filePath;
    }else {
      echo "File (.env) not exist. Create file .env in ROOT dir of application.";
    }
  }
  function dotEnv($dotEnv){
    $fileDotEnv = explode("\n", file_get_contents($this->path, true));
    foreach ($fileDotEnv as $envData) {
      if(preg_match('/^' . $dotEnv . ' = /',$envData)){
        $data = preg_replace('/^' . $dotEnv . ' = /', '' , $envData);
        return trim($data);
      }
    }
  }
}
?>

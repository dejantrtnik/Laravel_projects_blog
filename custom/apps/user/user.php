<?php
defined('BASEPATH') or exit('No direct script access allowed');
$conn = new Connection(
  (new Env('.env'))->dotEnv("db.oracle.hostname"),
  (new Env('.env'))->dotEnv('db.oracle.username'),
  (new Env('.env'))->dotEnv('db.oracle.password')
);


?>

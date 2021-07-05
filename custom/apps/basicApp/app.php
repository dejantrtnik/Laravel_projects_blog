<?php
 defined('BASEPATH') or exit('No direct script access allowed');


// Dont change
function appTelegram($app, $data){
  $env = new Env($app[0][0]['ENV']);
  $ip = new IpLocation($app[0][0]['IP']);
  $telegram = new Telegram($env->dotEnv($app[0][0]['BOT']), $env->dotEnv($app[0][0]['ID']));

  $msg = '🔔' . $data['header'] . '🔔'. "\n" .
         '*************************************************' . "\n" .
         'Pošiljatelj: ' . $data['name']                     . "\n" .
         'Email: '       . $data['email']                    . "\n" .
         'Datum: '       . date("d-m-Y")                     . "\n" .
         'Čas: '         . date("h:i:s")                     . "\n" .
         'Ip: '          . $_SERVER['REMOTE_ADDR']           . "\n" .
         'Država: '      . $ip->lookIp()['country']          . "\n" .
         'Mesto: '       . $ip->lookIp()['city']             . "\n" .
         '*************************************************' . "\n\n" .
         'Msg: ' . $data['msg'];

  $telegram->telegram($msg);
}
// Dont change
$app[] = array(
  array(
    'ENV' => '.env',
    'BOT' => 'BOT',
    'ID'  => 'ID',
    'IP'  => $_SERVER['REMOTE_ADDR']
  ),
  array(
    // some stuff
  )
);
?>

<?php
class Telegram
{
  function __construct($bot, $id)
  {
    $this->bot = $bot;
    $this->id = $id;
  }

  function telegram($msg)
  {
    $url = 'https://api.telegram.org/bot'. $this->bot . '/sendMessage';
    $data = array(
          'chat_id' => $this->id,
              'text'=> $msg
            );
    $options = array(
          'http' => array(
                'method' =>'POST',
                'header' =>"Content-Type:application/x-www-form-urlencoded\r\n",
                'content'=> http_build_query($data)
                ,),);
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);
  }
}



?>

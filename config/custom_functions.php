<?php
use App\Models\ipInfos;
use App\Models\visits;
use App\Models\WhiteList;
use App\Models\BlackList;

function rpi(){
  if (@file_get_contents('http://192.168.0.147/moduliRPI/sensor_H2O.php') === false) {
    return 'empty temp';
  }
  else {
    return @file_get_contents('http://192.168.0.147/moduliRPI/sensor_H2O.php');
  }
}

function photo_ip_cam(){
      $directory = 'storage/app/public/photo_ip_cam';
      $static_no_img = 'storage/app/public/static_images/live_view_progress.png';
      $images = glob($directory . "/*.jpg");
      $i = 0;
      foreach ($images as $image) {
        $i++;
      }
      if ($i > 1) {
        $img = $image;
      }
      if (empty($img)) {
        $img = $static_no_img;
        return $img;
      }else {
        return $img;
      }
    }

function remove_accent($str)
{
  $a = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ');
  $b = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o');
  return str_replace($a, $b, $str);
}
function post_slug($str)
{
  return strtolower(preg_replace(array('/[^a-zA-Z0-9 -]/', '/[ -]+/', '/^-|-$/'),
  array('', '-', ''), remove_accent($str)));
}


function ipwhois($ip){
  $ch = curl_init('http://ipwhois.app/json/' . $ip);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($ch);
  curl_close($ch);
  $ipwhois_result = json_decode($json, true);
  return $ipwhois_result;
}

function geoapify($ip){
  $ch = curl_init('https://api.geoapify.com/v1/ipinfo?&ip='.$ip.'&apiKey=47c38d36bb7b47e1930c019925c90513');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $json = curl_exec($ch);
  curl_close($ch);
  $geoapify_result = json_decode($json, true);
  return $geoapify_result;
}

function ip_block(){
  $ip = request()->server('REMOTE_ADDR');
  //$ip = '192.168.0.100';

  $ipBlock = new BlackList;
  $ipBlock = BlackList::where('ip', $ip)->exists();

}
//ip_block();

function ip_collect(){
  $ip = request()->server('REMOTE_ADDR');
  $request_url = request()->server('REQUEST_URI');
  //$ip = '79.106.34.2';
  //$ip = '66.249.64.227';
  //$ip = '193.77.83.59';
  //$ip = '51.38.33.36';
  //$ip = '192.168.0.100';

  $ipInfo = new WhiteList;
  $ipInfo = new ipInfos;
  $visits = new visits;
  $blackList = new BlackList;

  $blackList = BlackList::where('ip', $ip)->exists();
  $whiteList = WhiteList::where('ip', $ip)->exists();



  if (ipInfos::where('ipStrlen', post_slug($ip))->exists()) {
    if ($whiteList == true) {
      /*
      |--------------------------------------------------------------------------
      | white list
      |--------------------------------------------------------------------------
      | check if exist in white_list table
      |
      */
    }else {
      $visits->ipStrlen    = post_slug($ip);
      $visits->request_url = ($request_url);
      if (!empty(auth()->user()->id)) {
        $visits->user_id = (auth()->user()->id);
      }
      $visits->save();
    }
  }else {
    if ( ipwhois($ip) != null && ipwhois($ip)['success'] == true) {
      $ipQuery = 'ipwhois';
      $data = ipwhois($ip);
      $ipInfo->ipStrlen   = post_slug($data['ip']);
      $ipInfo->country    = $data['country'];
      $ipInfo->ip	        = $data['ip'];
      $ipInfo->city       = $data['city'];
      $ipInfo->latitude	  = $data['latitude'];
      $ipInfo->longitude  = $data['longitude'];
    }elseif ( geoapify($ip) != null && geoapify($ip)['statusCode'] != 400) {
      $ipQuery = 'geoapify';
      $data = geoapify($ip);
      $ipInfo->ipStrlen   = post_slug($data['ip']);
      $ipInfo->country    = $data['country']['name'];
      $ipInfo->ip	        = $data['ip'];
      $ipInfo->city       = $data['country']['capital'];
      $ipInfo->latitude	  = $data['location']['latitude'];
      $ipInfo->longitude  = $data['location']['longitude'];
    }elseif (ipwhois($ip)['success'] == false || geoapify($ip)['statusCode'] == 400) {
      if (ipwhois($ip)['message'] == 'invalid IP address') {
        $data = ipwhois($ip);
        $ipInfo->ipStrlen   = post_slug($ip);
      }elseif (geoapify($ip)['message'] == '"ip" must be a valid ip address with a optional CIDR') {
        $data = geoapify($ip);
        $ipInfo->ipStrlen   = post_slug($ip);
      }
    }
    $ipInfo->save();
  }
}

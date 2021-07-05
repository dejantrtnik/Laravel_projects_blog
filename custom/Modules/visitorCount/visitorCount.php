<?php

/**
 * must include "Modules/dotEnv/dotEnv.php";
 *
 */

class VisitorCount
{
  function __construct($tbl_database)
  {
    $this->tbl_database = $tbl_database;
  }

  function vistorsCount($conn){
    $tbl = $this->tbl_database;

    $os           = getOS();
    $browser      = getBrowser();
    $id_ip_strlen = post_slug($_SERVER['REMOTE_ADDR']);
    $ip_address   = $_SERVER['REMOTE_ADDR'];
    $request_url  = $_SERVER['REQUEST_URI'];

    $stmt = $conn->prepare("INSERT INTO $tbl (os, browser, request_url, id_ip_strlen, ip_address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssis", $os, $browser, $request_url, $id_ip_strlen, $ip_address);
    $stmt->execute();
    $stmt->close();
    $conn->close();
  }

  function firstVisit($conn){
    $tbl = $this->tbl_database;

    $os           = getOS();
    $browser      = getBrowser();
    $id_ip_strlen = post_slug($_SERVER['REMOTE_ADDR']);
    $ip_address   = $_SERVER['REMOTE_ADDR'];
    $request_url  = $_SERVER['REQUEST_URI'];

    $stmt = $conn->prepare("INSERT INTO $tbl (id_ip_strlen, os, browser, request_url, ip_address) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $id_ip_strlen, $os, $browser, $request_url, $ip_address);
    $stmt->execute();
    $stmt->close();
    $conn->close();
  }

  // extra option


}

// get os & browser
$user_agent = $_SERVER['HTTP_USER_AGENT'];
function getOS()
{
  global $user_agent;
  $os_platform  = "Unknown OS Platform";
  $os_array     = array(
                      '/windows nt 10/i'      =>  'Windows 10',
                      '/windows nt 6.3/i'     =>  'Windows 8.1',
                      '/windows nt 6.2/i'     =>  'Windows 8',
                      '/windows nt 6.1/i'     =>  'Windows 7',
                      '/windows nt 6.0/i'     =>  'Windows Vista',
                      '/windows nt 5.2/i'     =>  'Windows Server 2003/XP x64',
                      '/windows nt 5.1/i'     =>  'Windows XP',
                      '/windows xp/i'         =>  'Windows XP',
                      '/windows nt 5.0/i'     =>  'Windows 2000',
                      '/windows me/i'         =>  'Windows ME',
                      '/win98/i'              =>  'Windows 98',
                      '/win95/i'              =>  'Windows 95',
                      '/win16/i'              =>  'Windows 3.11',
                      '/macintosh|mac os x/i' =>  'Mac OS X',
                      '/mac_powerpc/i'        =>  'Mac OS 9',
                      '/linux/i'              =>  'Linux',
                      '/ubuntu/i'             =>  'Ubuntu',
                      '/iphone/i'             =>  'iPhone',
                      '/ipod/i'               =>  'iPod',
                      '/ipad/i'               =>  'iPad',
                      '/android/i'            =>  'Android',
                      '/blackberry/i'         =>  'BlackBerry',
                      '/webos/i'              =>  'Mobile'
                      );
  foreach ($os_array as $index => $value)
  {
    if (preg_match($index, $user_agent))
    {
      $os_platform = $value;
      return $os_platform;
    }
  }
}
function getBrowser()
{
  global $user_agent;
  $browser       = "Unknown Browser";
  $browser_array = array(
                      '/msie/i'      => 'Internet Explorer',
                      '/firefox/i'   => 'Firefox',
                      '/safari/i'    => 'Safari',
                      '/chrome/i'    => 'Google Chrome',
                      '/edge/i'      => 'Edge',
                      '/opera/i'     => 'Opera',
                      '/netscape/i'  => 'Netscape',
                      '/maxthon/i'   => 'Maxthon',
                      '/konqueror/i' => 'Konqueror',
                      '/mobile/i'    => 'Handheld Browser'
                      );
                      foreach ($browser_array as $index => $value)
                      {
                        if (preg_match($index, $user_agent))
                        {
                          $browser = $value;
                          return $browser;
                        }
                      }
}

// from ip to clean number
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
?>

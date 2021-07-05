<?php

class IpLocation
{
  public $visitorIp;
  function __construct($visitorIp)
  {
    $this->visitorIp = $visitorIp;
  }
  function lookIp()
  {
    $ch = curl_init('http://ipwhois.app/json/' . $this->visitorIp);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $json = curl_exec($ch);
    curl_close($ch);
    $ipwhois_result = json_decode($json, true);

    $all_data = array(
       'ip'                  => $ipwhois_result['ip'],
       'country'             => $ipwhois_result['country'],
       'city'                => $ipwhois_result['city'],
       'latitude'            => $ipwhois_result['latitude'],
       'longitude'           => $ipwhois_result['longitude'],
       'success'             => $ipwhois_result['success'],
       'type'                => $ipwhois_result['type'],
       'Continent'           => $ipwhois_result['continent'],
       'Continent_code'      => $ipwhois_result['continent_code'],
       'Country_code'        => $ipwhois_result['country_code'],
       'country_flag'        => $ipwhois_result['country_flag'],
       'country_capital'     => $ipwhois_result['country_capital'],
       'country_phone'       => $ipwhois_result['country_phone'],
       'country_neighbours'  => $ipwhois_result['country_neighbours'],
       'region'              => $ipwhois_result['region'],
       'asn'                 => $ipwhois_result['asn'],
       'org'                 => $ipwhois_result['org'],
       'isp'                 => $ipwhois_result['isp'],
       'timezone_name'       => $ipwhois_result['timezone_name'],
       'timezone_dstOffset'  => $ipwhois_result['timezone_dstOffset'],
       'timezone_gmtOffset'  => $ipwhois_result['timezone_gmtOffset'],
       'timezone_gmt'        => $ipwhois_result['timezone_gmt'],
       'currency'            => $ipwhois_result['currency'],
       'currency_code'       => $ipwhois_result['currency_code'],
       'currency_symbol'     => $ipwhois_result['currency_symbol'],
       'currency_rates'      => $ipwhois_result['currency_rates'],
       'currency_plural'     => $ipwhois_result['currency_plural'],
       'completed_requests'  => $ipwhois_result['completed_requests']

       );


    return $all_data;
  }
}
?>

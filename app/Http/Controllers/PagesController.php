<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ipInfos;
use App\Models\visits;
use App\Models\User;
use DB;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PagesController extends Controller
{
  public function index()
  {
    /*
    |--------------------------------------------------------------------------
    | ip_collect()
    |--------------------------------------------------------------------------
    | /var/www/html/config/custom_functions.php
    | collecting ip numbers in db
    */
    ip_collect();


    $data = [
      'title' => 'This is about',
      'ip' => request()->server('SERVER_ADDR'),
      'request_url' => request()->server('REQUEST_URI'),
      'temp_data_rpi' => file_get_contents('http://192.168.0.147/moduliRPI/sensor_H2O.php'),
      //'temp_data_rpi' => 'temp',
    ];

    //dd(ip_collect());
    return view('pages.index')->with($data);
  }


  public function info()
  {
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/');
    }

    function server(){
      $bytes_free = disk_free_space("/");
      $bytes_total = disk_total_space("/");

      $si_prefix = array( 'B', 'KB', 'MB', 'GB', 'TB', 'EB', 'ZB', 'YB' );
      $base = 1024;
      $class_free = min((int)log($bytes_free , $base) , count($si_prefix) - 1);
      $class_total = min((int)log($bytes_total , $base) , count($si_prefix) - 1);

      $procentage_value = round(( $bytes_free / $bytes_total ) * 100, 2);
      //$procentage = 100 - $procentage_value;
      //dd($procentage_value);

      $data = array(
        'disk_free' => sprintf('%1.2f' , $bytes_free / pow($base, $class_free)) . ' ' . $si_prefix[$class_free],
        'disk_total' => sprintf('%1.2f' , $bytes_total / pow($base, $class_total)) . ' ' . $si_prefix[$class_total],
        'disk_free_num' => sprintf('%1.2f' , $bytes_free / pow($base, $class_free)),
        'disk_total_num' => sprintf('%1.2f' , $bytes_total / pow($base, $class_total)),
        //'procentage' => $procentage,
        'procentage_value' => $procentage_value,
      );
      return $data;
    }

    //server();
    return view('admin/info_server')->with('server', server());
  }

  public function maintenance()
  {
    /*
    |--------------------------------------------------------------------------
    | ip_collect()
    |--------------------------------------------------------------------------
    | /var/www/html/config/custom_functions.php
    | collecting ip numbers in db
    */
    ip_collect();
    $data = [
    'title' => 'maintenance',
    //'php_info' => phpInfo(),
    ];
    //return view('pages.services');
    return view('pages/maintenance')->with($data);
  }

  public function about()
  {
    /*
    |--------------------------------------------------------------------------
    | ip_collect()
    |--------------------------------------------------------------------------
    | /var/www/html/config/custom_functions.php
    | collecting ip numbers in db
    */
    ip_collect();

    $data = [
    'title' => 'Welcome',
    'users' => User::all(),
    'request_url' => request()->server('REQUEST_URI'),
    ];
    return view('pages.about')->with($data);
  }

  public function contact($id)
  {
    /*
    |--------------------------------------------------------------------------
    | ip_collect()
    |--------------------------------------------------------------------------
    | /var/www/html/config/custom_functions.php
    | collecting ip numbers in db
    */
    ip_collect();
    $data = [
    'title' => '',
    'user' => User::find($id),
    ];

    return view('pages.contact')->with($data);
  }

  public function telegram(request $msg)
  {
    $bot = env('BOT');
    $id = env('ID');
    $message =
    '🪐👽‌[Laravel]: 👽🪐'               ."\n".
    'Name: '       .$msg['name']            ."\n".
    'Email: '      .$msg['email']           ."\n".
    'Subject: '    .$msg['subject']         ."\n".
    'Date: '       .date("H:i:s ( d-m-Y )") ."\n".
    'Ip address: ' .request()->server('REMOTE_ADDR')."\n".
    'Msg: '     .$msg['body'];

    $url = 'https://api.telegram.org/bot'. $bot . '/sendMessage';
    $data = array(
    'chat_id' => $id,
    'text'=> $message
    );
    $options = array(
    'http' => array(
    'method' =>'POST',
    'header' =>"Content-Type:application/x-www-form-urlencoded\r\n",
    'content'=> http_build_query($data)
    ,),);
    $context = stream_context_create($options);
    $result = file_get_contents($url, false, $context);

    if ($result) {
      return redirect('/about')->with('success', 'Message send');
    }else {
      return redirect('/about')->with('error', 'Message Not send');
    }
  }

  public function services()
  {
    $data = array(
    'title' => 'ones',
    'services' => ['one', 'two']
    );
    //return view('pages.services');
    return view('pages.services')->with($data);
  }

  public function coding($id)
  {
    $data = [
    'title' => $id,
    'maintenance' => 'in progress',
    'services' => ['one', 'two']
    ];
    //return view('pages.services');
    return view('pages.coding.form')->with($data);
  }


}

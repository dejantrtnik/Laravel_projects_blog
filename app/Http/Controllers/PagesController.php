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

    return view('pages.index')->with($data);
  }

  public function info()
  {
    $data = [
    'title' => 'ones',
    //'php_info' => phpInfo(),
    ];
    //return view('pages.services');
    return view('admin/info_server')->with($data);
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
      'title' => 'This is about',
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
      'title' => 'This is contact',
      'user' => User::find($id),
    ];
    $title = 'This is contact';
    return view('pages.contact')->with($data);
  }

  public function telegram(request $msg)
  {
    $bot = env('BOT');
    $id = env('ID');
    $message =
    '🪐👽‌[Laravel]: 👽🪐'             ."\n".
    'Name: '    .$msg['name']            ."\n".
    'Email: '   .$msg['email']           ."\n".
    'Subject: ' .$msg['subject']            ."\n".
    'Date: '    .date("H:i:s ( d-m-Y )") ."\n".
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


}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ip;
use App\Models\visits;
use App\Models\ipInfos;
use DB;


class IpController extends Controller
{

  public function index()
  {
    if (auth()->user()->role == 'admin') {
      $data = [
        'ip' => ipInfos::all(),
      ];

      //return view('admin.admin')->with($data);
      return view('admin.ip.index')->with($data);
    }
  }

  public function show($ipStrlen)
  {
    $data = [
      'ip' => visits::where('ipStrlen', $ipStrlen)->get(),
      'ip_country' => ipInfos::where('ipStrlen', $ipStrlen)->get(),
    ];
    //$ip = visits::where('ipStrlen', $ipStrlen)->get();
    //$ip = DB::select("SELECT * FROM visits WHERE ipStrlen = '$ipStrlen'");
    //Post::orderBy('id', 'desc')->paginate(5);
    //dd($ip);
    return view('admin.ip.show')->with($data);
  }

}

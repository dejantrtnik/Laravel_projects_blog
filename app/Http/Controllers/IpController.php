<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ip;
use App\Models\visits;
use App\Models\ipInfos;
use App\Models\BlackList;
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

  public function destroy($ip)
  {

    if ( auth()->user()->role == 'admin') {
      $black_list = DB::delete(" DELETE FROM black_list WHERE ip = '$ip' ");


      $blackListQuery = BlackList::all();
      $ht =
'<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>
    RewriteEngine On
    <FilesMatch "^\.">
    Order allow,deny
    Deny from all
    </FilesMatch>

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>';
      Storage::disk('public_custom')->put('.htaccess', $ht);
      foreach ($blackListQuery as $key => $value) {
        Storage::disk('public_custom')->append('.htaccess', 'Deny from '.$value->ip);
      }

      return redirect('/admin')->with('success', 'Ip deleted');
    }else {
      return redirect('/admin')->with('error', 'Ip NOT deleted');
    }
  }

  public function destroy_white_list($ip)
  {
    if ( auth()->user()->role == 'admin'){
      $white_list = DB::delete(" DELETE FROM white_list WHERE ip = '$ip' ");
      return redirect('/admin')->with('success', 'Ip deleted');

    }
  }

}

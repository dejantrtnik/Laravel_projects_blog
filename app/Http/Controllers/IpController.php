<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ip;
use App\Models\visits;
use App\Models\ipInfos;
use App\Models\BlackList;
use App\Models\WhiteList;
use App\Models\User;
use DB;


class IpController extends Controller
{

  public function index()
  {
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/');
    }
    if (auth()->user()->role == 'admin') {
      $data = [
        //'ip' => ipInfos::all(),
        'ip' => ipInfos::orderBy('created_at', 'desc')->get(),
      ];

      //return view('admin.admin')->with($data);
      return view('admin.ip.index')->with($data);
    }
  }

  public function show($table)
  {
    //dd($table);

    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/posts')->with('error', 'Unauthorized page');
    }

    $data = [
      'ip' => visits::orderBy('created_at', 'desc')->where('ipStrlen', $table)->get(),
      'ip_country' => ipInfos::where('ipStrlen', $table)->get(),
    ];
    return view('admin.ip.show')->with($data);

  }

  public function showCountry($table)
  {
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/posts')->with('error', 'Unauthorized page');
    }

    function group_country(){
      return DB::select("SELECT country FROM ip_infos GROUP by country");
    }

    $data = [
      'ip' => visits::where('ipStrlen', $table)->get(),
      'ip_country' => ipInfos::where('country', $table)->get(),
      'query_black_list' => BlackList::all(),
      'query_white_list' => WhiteList::all(),
      'title' => $table,
    ];
    return view('admin.ip.country.show')->with($data);

  }

  public function showVisit($user_id)
  {
    //dd($user_id);
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/posts')->with('error', 'Unauthorized page');
    }

    $data = [
      'users' => User::where('id', $user_id)->get(),
      'request_url' => visits::where('user_id', $user_id)->get(),
    ];
    return view('admin.ip.user.show')->with($data);

  }



  public function destroy($ip)
  {

    if (auth()->user()->role == 'admin') {
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

      return redirect(url()->previous())->with('success', 'Ip deleted - '.$ip);
    }else {
      return redirect(url()->previous())->with('error', 'Ip NOT deleted');
    }
  }

  public function destroy_white_list($ip)
  {
    if ( auth()->user()->role == 'admin'){
      $white_list = DB::delete(" DELETE FROM white_list WHERE ip = '$ip' ");
      return redirect(url()->previous())->with('success', 'Ip deleted - '. $ip);

    }
  }

  public function search(Request $request)
  {
    // Get the search value from the request
    $search = $request->input('search');
    // Search in the title and body columns from the posts table
    $data = [
      'query' => ipInfos::query()->where('ip', 'LIKE', "%{$search}%")->orWhere('country', 'LIKE', "%{$search}%")->get(),
    ];
    // Return the search view with the resluts compacted
    //return view('admin.ip.search', compact('query'));
    return view('admin.ip.search')->with($data);
  }

}

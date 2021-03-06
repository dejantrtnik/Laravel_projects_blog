<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use App\Models\visits;
use App\Models\ipInfos;
use App\Models\Comments;
use App\Models\WhiteList;
use App\Models\BlackList;
use App\Models\userLogin;
use DB;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    //dd(base_path());
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/');
    }

    function userMonthCountJson(){
      $dates = array(
        'January'   => date('Y'). '-01-01 12:00:00',
        'February'  => date('Y'). '-02-01 12:00:00',
        'March'     => date('Y'). '-03-01 12:00:00',
        'April'     => date('Y'). '-04-01 12:00:00',
        'May'       => date('Y'). '-05-01 12:00:00',
        'June'      => date('Y'). '-06-01 12:00:00',
        'July'      => date('Y'). '-07-01 12:00:00',
        'August'    => date('Y'). '-08-01 12:00:00',
        'September' => date('Y'). '-09-01 12:00:00',
        'October'   => date('Y'). '-10-01 12:00:00',
        'November'  => date('Y'). '-11-01 12:00:00',
        'December'  => date('Y'). '-12-01 12:00:00'
      );

      // db query without ralation tables ( count all )
      $dataOther = array(
        users_per_month($dates['January'], $dates['February']),
        users_per_month($dates['February'], $dates['March']),
        users_per_month($dates['March'], $dates['April']),
        users_per_month($dates['April'], $dates['May']),
        users_per_month($dates['May'], $dates['June']),
        users_per_month($dates['June'], $dates['July']),
        users_per_month($dates['July'], $dates['August']),
        users_per_month($dates['August'], $dates['September']),
        users_per_month($dates['September'], $dates['October']),
        users_per_month($dates['October'], $dates['November']),
        users_per_month($dates['November'], $dates['December']),
        users_per_month($dates['December'], (date('Y') + 1). '-01-01 12:00:00'),
        );
        return json_encode($dataOther);
      }

      function group_country(){
        return DB::select("SELECT country FROM ip_infos GROUP by country");
      }

      function countryMonthCountJson(){
        $country = DB::select("SELECT country FROM ip_infos GROUP by country");
        return json_encode($country);
      }


      function users_per_month($datein, $dateout){
        $users_count = User::whereBetween('created_at', [$datein, $dateout])->count();
        return $users_count;
      }

      if (auth()->user()->role == 'admin') {
        $data = [
        'users' => User::orderBy('id', 'asc')->paginate(5),
        'posts' => Post::orderBy('id', 'desc')->paginate(5),
        'users_count' => User::all(),
        'posts_count' => Post::all(),
        'ip_count' => visits::all(),
        'ip_unigue_count' => group_country(),
        'comments' => Comments::All(),
        'countries' => group_country(),
        'users_per_month' => userMonthCountJson(),
        'last_registered' => User::orderBy('created_at', 'desc')->first(),
        'last_post' => Post::orderBy('created_at', 'desc')->first(),
        'last_comment' => Comments::orderBy('created_at', 'desc')->first(),
        'users_admin' => DB::select("SELECT * FROM users WHERE role = 'admin'"),
        'users_guest' => DB::select("SELECT * FROM users WHERE role = 'guest' "),
        'users_member' => DB::select("SELECT * FROM users WHERE role = 'member'"),
        'countryMonthCountJson' => countryMonthCountJson(),
        'white_list' => WhiteList::All(),
        'black_list' => BlackList::All(),
        //'ipwhois' => ipwhois('192.168.0.350'),
        //'geoapify' => geoapify('192.168.0.350'),
        'months' => json_encode([
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
        ]),
        ];

        return view('admin.admin')->with($data);
      }
    }

    public function edit_role(request $role)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      $user = User::find($role['id']);
      $user->role = $role['role'];
      $user->save();
      return redirect('/admin/users')->with('success', 'Role added - '. $role['role'] );
    }

    public function white_list(request $list)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      $whiteList = WhiteList::where('ip', $list['white_list_ip'])->exists();
      $blackList = BlackList::where('ip', $list['white_list_ip'])->exists();

      if ($blackList == true) {
        return redirect(url()->previous())->with('error', 'IP exist in BLACK list database - '. $list['white_list_ip'] );
      }
      if ($whiteList == true) {
        return redirect(url()->previous())->with('error', 'IP already exist in database - '. $list['white_list_ip'] );
      }
      $white_list = new WhiteList();
      $white_list->ip = $list['white_list_ip'];
      $white_list->save();
      return redirect(url()->previous())->with('success', 'Ip added - '. $list['white_list_ip'] );
    }

    public function black_list(request $list)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      $blackList = BlackList::where('ip', $list['black_list_ip'])->exists();
      $whiteList = WhiteList::where('ip', $list['black_list_ip'])->exists();

      if ($whiteList == true) {
        return redirect(url()->previous())->with('error', 'IP exist in WHITE list database - '. $list['black_list_ip'] );
      }
      if ($blackList == true) {
        return redirect(url()->previous())->with('error', 'IP already exist in database - '. $list['black_list_ip'] );
      }
      $blackList = new BlackList();
      $blackList->ip = $list['black_list_ip'];
      $blackList->save();


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
      return redirect(url()->previous())->with('success', 'Ip added - '. $list['black_list_ip'] );
    }




    public function users()
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      if (auth()->user()->role == 'admin') {
        $data = [
        'users' => User::orderBy('id', 'asc')->paginate(5),
        'users_admin' => DB::select("SELECT * FROM users WHERE role = 'admin'"),
        'users_guest' => DB::select("SELECT * FROM users WHERE role = 'guest'"),
        'users_member' => DB::select("SELECT * FROM users WHERE role = 'member'"),
        'password_resets' => DB::select("SELECT * FROM password_resets"),
        'comments' => Comments::All(),
        ];

        return view('admin.users')->with($data);
      }
      return redirect('/dashboard')->with('error', 'Unauthorized page');
    }

    public function users_req()
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      if (auth()->user()->role == 'admin') {
        $data = [
        'users' => User::orderBy('id', 'asc')->paginate(5),
        'users_admin' => DB::select("SELECT * FROM users WHERE role = 'admin'"),
        'users_guest' => DB::select("SELECT * FROM users WHERE role = 'guest'"),
        'users_member' => DB::select("SELECT * FROM users WHERE role = 'member'"),
        'password_resets' => DB::select("SELECT * FROM password_resets"),
        'comments' => Comments::All(),
        ];

        return view('admin.users_req')->with($data);
      }
      return redirect('/dashboard')->with('error', 'Unauthorized page');
    }

    public function posts()
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      if (auth()->user()->role == 'admin') {
        $data = [
        'posts' => Post::orderBy('id', 'desc')->paginate(5),
        'post_by_user' => Post::all(),
        'comments' => Comments::orderBy('id', 'asc')->paginate(5),
        ];

        return view('admin.posts')->with($data);
      }
    }

    public function create()
    {
      return view('admin.users.create', ['roles' => Role::all()]);
    }

    public function show($user_id)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      if (auth()->user()->role == 'admin') {
        $data = [
        'posts' => Post::where('user_id', $user_id)->get(),
        ];
        //dd($data);
        return view('admin.show')->with($data);
      }
    }

    public function show_login()
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      if (auth()->user()->role == 'admin') {
        $data = [
        //'title' => 'user login detail time date',
        //'user_login' => userLogin::orderBy('id', 'desc')->get(),
        'user_login' => userLogin::groupBy('user_id')->selectRaw('count(*) as total, user_id')->get(),
        //'user' => User::orderBy('id', 'desc')->get(),
        ];
        //dd($data);
        return view('admin.users_login')->with($data);
      }
    }

    public function show_detail_by_user($user_id)
    {
      //dd($user_id);
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }

      function query($user_id){
        return User::where('id', $user_id)->get();
      }

      $data = [
      'user_login' => userLogin::groupBy('user_id')->selectRaw('count(*) as total, user_id')->get(),
      'user_details' => userLogin::orderBy('created_at', 'desc')->where('user_id', $user_id)->paginate(10),
      'users' => query($user_id),
      ];
      return view('admin.users_login')->with($data);

    }

    public function graf()
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      if (auth()->user()->role == 'admin') {
        $data = [
        'posts' => Post::all(),
        'ip_count' => visits::all(),
        ];
        return view('admin.graf')->with($data);
      }
      return redirect('/dashboard')->with('error', 'Unauthorized page');
    }

  }

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use App\Models\visits;
use App\Models\ipInfos;
use App\Models\Comments;
use DB;

class AdminController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {

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
        //$country = [];
        //dd($country);
      //$country = DB::select("SELECT country FROM ip_infos GROUP by country");
      //$country = array();

      $country = DB::table('ip_infos')
                 ->select('country', DB::raw('count(*) as count'))
                 ->groupBy('country')
                 ->get();
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
        'ip_unigue_count' => ipInfos::all(),
        'comments' => Comments::All(),
        'countries' => group_country(),
        'users_per_month' => userMonthCountJson(),
        'last_registered' => User::orderBy('created_at', 'desc')->first(),
        'last_post' => Post::orderBy('created_at', 'desc')->first(),
        'last_comment' => Comments::orderBy('created_at', 'desc')->first(),
        'users_admin' => DB::select("SELECT * FROM users WHERE role = 'admin'"),
        'users_guest' => DB::select("SELECT * FROM users WHERE role = 'guest' ORDER BY created_at DESC LIMIT 1"),
        'users_member' => DB::select("SELECT * FROM users WHERE role = 'member'"),
        'countryMonthCountJson' => countryMonthCountJson(),
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
      return redirect('/dashboard')->with('error', 'Unauthorized page');
    }

    //dd($data);
    public function edit_role(request $role)
    {



      $user = User::find($role['id']);

      //dd($user);

      $user->role = $role['role'];
      $user->save();

      return redirect('/admin/users')->with('success', 'Role added - '. $role['role'] );


    }


    public function users()
    {
      if (auth()->user()->role == 'admin') {
        $data = [
        'users' => User::orderBy('id', 'asc')->paginate(5),
        'users_admin' => DB::select("SELECT * FROM users WHERE role = 'admin'"),
        'users_guest' => DB::select("SELECT * FROM users WHERE role = 'guest'"),
        'users_member' => DB::select("SELECT * FROM users WHERE role = 'member'"),
        'password_resets' => DB::select("SELECT * FROM password_resets"),
        ];

        return view('admin.users')->with($data);
      }
      return redirect('/dashboard')->with('error', 'Unauthorized page');
    }

    public function posts()
    {
      if (auth()->user()->role == 'admin') {
        $data = [
        'posts' => Post::orderBy('id', 'desc')->paginate(5),
        'post_by_user' => Post::all(),
        ];

        return view('admin.posts')->with($data);
      }
      return redirect('/dashboard')->with('error', 'Unauthorized page');
    }

    public function create()
    {
      return view('admin.users.create', ['roles' => Role::all()]);
    }

    public function show($user_id)
    {
      if (auth()->user()->role == 'admin') {
        $data = [
        'posts' => Post::where('user_id', $user_id)->get(),
        ];
        //dd($data);
        return view('admin.show')->with($data);
      }
      return redirect('/dashboard')->with('error', 'Unauthorized page');
    }

    public function graf()
    {
      if (auth()->user()->role == 'admin') {
        $data = [
        'posts' => Post::all(),
        'ip_count' => visits::all(),
        ];
        //dd($data);
        return view('admin.graf')->with($data);
      }
      return redirect('/dashboard')->with('error', 'Unauthorized page');
    }



  }

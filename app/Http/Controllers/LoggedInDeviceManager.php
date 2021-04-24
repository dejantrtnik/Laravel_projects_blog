<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class LoggedInDeviceManager extends Controller
{
  public function index()
  {
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/');
    }
    //$devices = \DB::table('sessions')
    //->where('user_id', \Auth::user()->id)
    //->get()->reverse();

    $data =  [
      'devices' => \DB::select("SELECT * FROM sessions"),
      'users' => \DB::select("SELECT * FROM users"),
    ];

    return view('admin.list')->with($data)->with('current_session_id', \Session::getId());
  }

  public function logoutDevice(Request $request, $device_id)
  {

    \DB::table('sessions')->where('id', $device_id)->delete();
    return redirect('admin/logged_in_devices');
  }

  public function logoutAllDevices(Request $request)
  {
    //dd($request);
    //\DB::table('sessions')
    //->where('user_id', \Auth::user()->id)
    //->where('id', '!=', \Session::getId())->delete();
    $session_count = \DB::select("DELETE FROM sessions WHERE user_id IS NULL");

    return redirect('admin/logged_in_devices');
  }
}

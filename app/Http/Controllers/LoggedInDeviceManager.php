<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DB;

class LoggedInDeviceManager extends Controller
{
  /**
  * Display a listing of the currently logged in devices.
  *
  * @return \Illuminate\Http\Response
  */
  public function index()
  {

    //$devices = \DB::table('sessions')
    //->where('user_id', \Auth::user()->id)
    //->get()->reverse();

    $data =  [
      'devices' => \DB::select("SELECT * FROM sessions"),
      'users' => \DB::select("SELECT * FROM users"),
    ];

    return view('admin.list')->with($data)->with('current_session_id', \Session::getId());
  }


  /**
  * Logout a session based on session id.
  *
  * @return \Illuminate\Http\Response
  */
  public function logoutDevice(Request $request, $device_id)
  {

    \DB::table('sessions')->where('id', $device_id)->delete();
    return redirect('admin/logged_in_devices');
  }



  /**
  * Logouts a user from all other devices except the current one.
  *
  * @return \Illuminate\Http\Response
  */
  public function logoutAllDevices(Request $request)
  {
    \DB::table('sessions')
    ->where('user_id', \Auth::user()->id)
    ->where('id', '!=', \Session::getId())->delete();

    return redirect('admin/logged_in_devices');
  }
}

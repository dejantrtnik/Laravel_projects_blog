<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = '/dashboard';

    protected function redirectTo()
    {
        return '/dashboard';
    }


    public function __construct()
    {
        $this->middleware('guest');
    }


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }


    protected function create(array $data)
    {
      function telegram($data){
        $bot = env('BOT');
        $id = env('ID');
        $message =
        'New user register'               ."\n".
        'Name: '       .$data['name']            ."\n".
        'Email: '      .$data['email']           ."\n".
        'Date: '       .date("H:i:s ( d-m-Y )") ."\n".
        'Ip address: ' .request()->server('REMOTE_ADDR');

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
      }



        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            telegram($data),
        ]);
    }
}

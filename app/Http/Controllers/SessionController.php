<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{

    //public function __construct(){
//
    //    $product = array(1,2,3,4);
    //    Session::push('cart', $product);
    //  
    //}

    public function accessSessionData(Request $request) {
        if ($request->session()->has('ip')) 
            return view('ipLocation.index')->with('request', $request);
        else {
            echo 'No data in the session';
        }

     }

     public function storeSessionData(Request $request) {

        //$ip_address = request()->server('SERVER_ADDR');
        //$request->session()->put('ip', $ip_address);
        

        $dataArray = [
            //'ip' => 'krneki'
            request()->server('SERVER_ADDR'),
            request()->server('SERVER_NAME'),
            
        ];
        Session::put('cart.product',$product);
        
        //$request->session()->put(array($dataArray));

        echo "Data has been added to session";
     }

     public function deleteSessionData(Request $request) {
        $request->session()->forget('ip');
        echo "Data has been removed from session.";
     }
}

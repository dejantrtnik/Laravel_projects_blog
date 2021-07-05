<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Post;
use App\Models\Comments;
use DB;

class UserController extends Controller
{

  public function index()
  {
    $data = [
      'title' => 'User profile',
      'users' => DB::table('users')->get(),
      'posts' => Post::all(),
    ];
    return view('user.index')->with($data);
  }


  public function create(Request $request)
  {
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/dashboard');
    }
    return view('user.create');
  }


  public function store(Request $request)
  {
    $user = new User();
    if ($user) {
      $user->name = $request['name'];
      $user->email = $request['email'];
      $user->password = Hash::make($request['password']);
      $user->save();

      return redirect('/admin/users')->with('success', 'User created');
    }else {
      return redirect()->back();
    }
    return redirect('/admin/users')->with('success', 'User creted');
  }


  public function show($id)
  {
    /*
    |--------------------------------------------------------------------------
    | ip_collect()
    |--------------------------------------------------------------------------
    | /var/www/html/config/custom_functions.php
    | collecting ip numbers in db
    */
    ip_collect();
    $user = User::find($id);
    $data = [
      'user' => User::find($id),
      'posts' => Post::orderBy('id', 'desc')->where('user_id', $id)->get(),
      'comments' => Comments::orderBy('id', 'desc')->where('user_id', $id)->get(),

    ];
    if ( auth()->user()->id == $user->id || auth()->user()->role == 'admin' ) {
      //dd($data);
      return view('user.show')->with($data);
    }else {
      return redirect('/user')->with('error', 'Unauthorized page');
    }
  }


  public function edit($id)
  {
    /*
    |--------------------------------------------------------------------------
    | ip_collect()
    |--------------------------------------------------------------------------
    | /var/www/html/config/custom_functions.php
    | collecting ip numbers in db
    */
    ip_collect();
    if (Auth::user()) {
      $user = User::find($id);

      if (auth()->user()->id == $id || auth()->user()->role == 'admin') {
        return view('user.edit')->withUser($user);
      }else {
        return redirect()->back();
      }
    }else {
      return redirect()->back();
    }
  }


  public function update(Request $request, $id)
  {


    $user = User::find($id);

    if ($user) {
      $user->name = $request['name'];
      $user->email = $request['email'];
      $user->password = Hash::make($request['password']);
      if ( empty($user->role = $request['role']) ) {
        $user->role = 'guest';
      }else {
        $user->role = $request['role'];
      }
      $user->save();

      if (auth()->user()->role == 'admin') {
        return redirect('/admin/users')->with('success', 'User updated');
      }else {
        return redirect('/dashboard')->with('success', 'User updated');

      }
    }else {
      return redirect()->back();
    }
    //dd($id);
    //$user = User::find($id);
    ////$user = new User($id);
    //$user->name = $request->input('name');
    //$user->email = $request->input('email');
    //$user->password = Hash::make($request->input('password'));
    ////$user->role = $request->input('role')->default('guest');
    //$user->save();
  }

  public function destroy($id)
  {
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/');
    }

    if ( auth()->user()->role == 'admin') {
      $user = User::find($id);

      // delete posts which belongs to delete user
      $posts = DB::delete(" DELETE FROM posts WHERE user_id = '$id' ");
      $posts = DB::delete(" DELETE FROM comments WHERE user_id = '$id' ");
      //dd($posts);
      //$post->delete();
      $user->delete();
      return redirect('/admin/users')->with('success', 'User deleted');
    }else {
      return redirect('/admin/users')->with('error', 'User NOT deleted');
    }
  }

  public function search(Request $request)
  {
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/');
    }
    /*
    |--------------------------------------------------------------------------
    | ip_collect()
    |--------------------------------------------------------------------------
    | /var/www/html/config/custom_functions.php
    | collecting ip numbers in db
    */
    ip_collect();
    // Get the search value from the request
    $search = $request->input('search');

    // Search in the title and body columns from the posts table
    $users = User::query()
    ->where('name', 'LIKE', "%{$search}%")
    ->orWhere('email', 'LIKE', "%{$search}%")
    ->get();

    // Return the search view with the resluts compacted
    return view('user.search', compact('users'));
  }
}

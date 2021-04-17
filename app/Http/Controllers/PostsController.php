<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Post;
use App\Models\User;
use App\Models\Comments;
use DB;

class PostsController extends Controller
{
  function __construct()
  {

    $this->middleware('auth', ['except' => ['index', ]]);
    //$this->middleware('auth', ['except' => ['index', 'show']]);
  }

  public function index()
  {

    /*
    |--------------------------------------------------------------------------
    | ip_collect()
    |--------------------------------------------------------------------------
    | /var/www/html/config/custom_functions.php
    | collecting ip numbers in db
    */
    ip_collect();

    function comment_count(){
      //$query = [];
      $query = DB::select("SELECT id_post FROM comments");

      return $query;
    }

    $data = [
      'title' => 'This is Project',
      'request_url' => request()->server('REQUEST_URI'),
      'posts' => Post::orderBy('id', 'desc')->paginate(5),
      'post_count' => Post::all(),
      'user' => User::all(),
      'comments' => Comments::All(),
      'comment_count' => comment_count(),
    ];
    return view('posts.index')->with($data);

  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    $data = [
    'msg_warning' => 'Please contact the admin',
    ];
    return view('posts.create')->with($data);
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    $this->validate($request, [
    'title' => 'required',
    'body' => 'required',
    'cover_image' => 'image|nullable|max:9999'
    ]);

    // hande file upload
    if ( $request->hasFile('cover_image') ) {
      // get filename with the extension
      $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
      // get just filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      // get fust extension
      $extension = $request->file('cover_image')->getClientOriginalExtension();
      // filename to store
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      // upload image
      $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    }else {
      $fileNameToStore = 'noimage.jpg';
    }

    // create posst
    $post = new Post;
    $post->title = $request->input('title');
    $post->body = $request->input('body');
    $post->user_id = auth()->user()->id;
    $post->cover_image = $fileNameToStore;
    $post->save();


    if (auth()->user()->role == 'admin') {
      return redirect('/admin/posts')->with('success', 'Post creted');
    }else {
      return redirect('/posts')->with('success', 'Post creted');
    }
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
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

    $data = [
    'post' => Post::find($id),
    'users' => User::all(),
    'comments' => Comments::All(),
    ];

    foreach ($data as $key => $value) {
      if ($value == null) {
        return redirect('/posts');
      }
      //dd($value);
    }
    return view('posts.show')->with($data);
  }


  public function showAll($user_id)
  {
    /*
    |--------------------------------------------------------------------------
    | ip_collect()
    |--------------------------------------------------------------------------
    | /var/www/html/config/custom_functions.php
    | collecting ip numbers in db
    */
    ip_collect();

    $data = [
    'posts' => Post::where('user_id', $user_id)->get(),
    'users' => User::all(),
    ];
    //dd($user_id);
    //dd($data);
    return view('posts.showAll')->with($data);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
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


    $post = Post::find($id);
    // check for correct user
    // if(auth()->user()->id !== $post->id && auth()->user()->role !== 'admin'){
    //     return redirect('/posts')->with('error', 'Unauthorized page');
    // }

    if(auth()->user()->id == $post->user_id || auth()->user()->role == 'admin'){
      return view('posts.edit')->with('post', $post);
    }

    // if(auth()->user()->id == $post->user_id){
    //     return view('posts.edit')->with('post', $post);
    // }elseif (auth()->user()->role == 'admin'){
    //     return view('posts.edit')->with('post', $post);
    // }

    return redirect('/posts')->with('error', 'Unauthorized page');
  }

  /**
  * Update the specified resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function update(Request $request, $id)
  {
    $this->validate($request, [
    'title' => 'required',
    'body' => 'required',
    ]);

    // hande file upload
    if ( $request->hasFile('cover_image') ) {
      // get filename with the extension
      $filenameWithExt = $request->file('cover_image')->getClientOriginalName();
      // get just filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      // get fust extension
      $extension = $request->file('cover_image')->getClientOriginalExtension();
      // filename to store
      $fileNameToStore = $filename.'_'.time().'.'.$extension;
      // upload image
      $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
    }

    $post = Post::find($id);
    $post->title = $request->input('title');
    $post->body = $request->input('body');
    if ( $request->hasFile('cover_image') ) {
      $post->cover_image = $fileNameToStore;
    }
    $post->save();

    return redirect('/posts')->with('success', 'Post updated');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    $post = Post::find($id);

    // comments below post deletes "ralation" CASCADE in db

    // check for correct user
    if(auth()->user()->id !== $post->id && auth()->user()->role !== 'admin'){
      if (auth()->user()->id == $post->user_id) {
        $post->delete();
        return redirect('/posts')->with('success', 'Post deleted');
      }
      return redirect('/posts')->with('error', 'Unauthorized page');
    }

    if ( $post->cover_image != 'noimage.jpg' ) {
      // delete image
      Storage::delete('public/cover_images/'.$post->cover_image);
    }

    //dd($id);
    $post->delete();


    if (auth()->user()->role == 'admin') {
      return redirect('/admin/posts')->with('success', 'Post deleted');
    }else {
      return redirect('/posts')->with('success', 'Post deleted');
    }
  }

  public function search(Request $request){

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
    $posts = Post::query()
    ->where('title', 'LIKE', "%{$search}%")
    ->orWhere('body', 'LIKE', "%{$search}%")
    ->get();

    // Return the search view with the resluts compacted
    return view('posts.search', compact('posts'));
  }
}

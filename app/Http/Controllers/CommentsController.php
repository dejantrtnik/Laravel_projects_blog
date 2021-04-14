<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use App\Models\Comments;
use DB;

class CommentsController extends Controller
{

    public function index()
    {
      $data = [
      'comments' => Comments::orderBy('id', 'desc')->paginate(5),
      'comment_count' => Comments::all(),
      'posts' => Post::all(),
      'users' => User::all(),
      ];
      return view('admin.comments')->with($data);
    }

    public function create()
    {

    }

    public function store(Request $request, $id )
    {
      //dd($request);
      /*
      |--------------------------------------------------------------------------
      | ip_collect()
      |--------------------------------------------------------------------------
      | /var/www/html/config/custom_functions.php
      | collecting ip numbers in db
      */
      //ip_collect();


      $comments = new Comments;
      $comments->id_post = $request->input('id_post');
      $comments->post_user_id = $request->input('post_user_id');
      $comments->user_id = $request->input('user_id');
      $comments->comment = $request->input('comment');

      $comments->save();
      return redirect('/posts/'. $request->id)->with('success', 'Comment send successfully');

      //return redirect('/posts/'. $request->id);

      //if (auth()->user()->role == 'admin') {
      //}else {
      //  return redirect('/posts')->with('success', 'Post creted');
      //}
      //$data = [
      //'post' => Post::find($id),
      //'users' => User::all(),
      //'users' => Comments::all(),
      //];
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }


    public function destroy($id)
    {
      // check for correct user
      // check for correct user
      //dd($Comment);

      if(auth()->user()->role == 'admin'){
        $Comment = Comments::find($id);
        $Comment->delete();
        return redirect( url()->previous() )->with('success', 'Comment deleted');
      }
      return redirect('/')->with('error', 'Unauthorized page');
    }
}

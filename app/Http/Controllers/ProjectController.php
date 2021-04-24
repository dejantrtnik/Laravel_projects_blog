<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\projects;
use DB;

class ProjectController extends Controller
{

  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
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

    $data = [
      'title' => 'This is Project',
      'ip' => request()->server('SERVER_ADDR'),
      'request_url' => request()->server('REQUEST_URI'),
      'projects' => projects::orderBy('id', 'desc')->paginate(10),
      'projects_array' => array(projects::all()),
    ];

    return view('project.index')->with($data);
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    if (auth()->user()->role == 'admin') {
      return view('project.create');
    }
    $user_id = auth()->user()->id;
    $user = User::find($user_id);
    return view('dashboard')->with('posts', $user->posts);
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
    'topic' => 'required',
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
    //dd($request);
    if (auth()->user()->role == 'admin') {
      $project = new projects();
      $project->title = $request->input('title');
      $project->topic = $request->input('topic');
      $project->body = $request->input('body');
      if ( $request->hasFile('cover_image') ) {
        $project->cover_image = $fileNameToStore;
      }
      $project->save();
      return redirect('/admin/project')->with('success', 'Project created');
    }

    return redirect('/')->with('error', 'Unauthorized page');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show()
  {
    if (auth()->user() == null || auth()->user()->role != 'admin') {
      return redirect('/project');
    }
    $data = [
    'title' => 'Projects',
    'projects' => projects::orderBy('id', 'desc')->get(),
    //'projects_array' => array(projects::all()),
    ];
    return view('project.show')->with($data);
  }

  public function show_detail($id)
  {

    $data = [
    'title' => 'Projects',
    'projects' => 'Some projects',
    'projects' => projects::find($id),
    'projects_array' => array(projects::all()),
    ];
    return view('project.show_detail')->with($data);
  }

  /**
  * Show the form for editing the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function edit($id)
  {
    //dd($id);
    if (auth()->user()->role == 'admin') {
      $data = [
        'title' => 'Projects',
        'projects' => 'Some projects',
        'projects' => projects::find($id),

        'projects_array' => array(projects::all()),
      ];
      return view('project.edit')->with($data);
    }else {
      return redirect('/posts')->with('error', 'Unauthorized page');
    }
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
    //dd($id);
    if (auth()->user()->role == 'admin') {
      $project = projects::find($id);
      $project->title = $request->input('title');
      $project->topic = $request->input('topic');
      $project->body = $request->input('body');
      if ( $request->hasFile('cover_image') ) {
        $project->cover_image = $fileNameToStore;
      }
      $project->save();
      return redirect('/admin/project')->with('success', 'Project updated');
    }

    return redirect('/')->with('error', 'Unauthorized page');
  }

  /**
  * Remove the specified resource from storage.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function destroy($id)
  {
    //dd($id);

    if ( auth()->user()->role == 'admin') {
      //$project = projects::find($id);

      // delete posts which belongs to delete user
      $project = DB::delete(" DELETE FROM projects WHERE id = '$id' ");
      //dd($posts);
      //$post->delete();
      //$project->delete();
      return redirect('/admin/project')->with('success', 'Project deleted');
    }else {
      return redirect('/admin/project')->with('error', 'Project NOT deleted');
    }
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class backupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      $data = [
        'title' => 'backup',
      ];
        return view('admin.backup')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      dd($request);

      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
      $data = [
        'title' => 'backup',
      ];
        return view('admin.backup')->with($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
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
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
    }
}

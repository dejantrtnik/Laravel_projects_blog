<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class backupController extends Controller
{
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

    public function create()
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }

    }

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

    public function show($id)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
    }

    public function edit($id)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
    }

    public function update(Request $request, $id)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
    }

    public function destroy($id)
    {
      if (auth()->user() == null || auth()->user()->role != 'admin') {
        return redirect('/');
      }
    }
}

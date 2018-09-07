<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TodoController extends Controller
{
    public function index(){
        return view('index');
    }

    public function edit(){
        return view('edit');
    }
}

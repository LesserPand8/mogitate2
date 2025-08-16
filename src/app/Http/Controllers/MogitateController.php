<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MogitateController extends Controller
{
    public function index()
    {
        return view('index');
    }

    public function register()
    {
        return view('register');
    }
}

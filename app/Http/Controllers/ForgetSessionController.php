<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

class ForgetSessionController extends Controller
{
    public function __construct() {
      
    }
    public function index(Request $request)
    {
       $name = $request->get('name');
       session()->forget($name);
       return session()->save();
    }
}

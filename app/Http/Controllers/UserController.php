<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function regis(){
      return view('register');
    }

    public function store(Request $request){
      
    }
}

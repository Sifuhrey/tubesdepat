<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class userController extends Controller
{
    public function index()
    {

        return view(
            'login'
        );
    }
    public function store(Request $request){

    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller {
  public function regis() {
    return view('register');
  }
  public function login() {
    return view('login');
  }
  public function store(Request $request) {


    $request->validate([
      'username' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|string|min:8',

    ]);

    $user = new User();
    $user->username = $request->input('username');
    $user->email = $request->input('email');
    $user->password = bcrypt($request->input('password'));
    $user->save();

    Log::info('Redirecting to login');
    return redirect()->route('login');
  }
}

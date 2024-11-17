<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class userController extends Controller
{
    public function regis(){
      return view('register');
    }
    public function login()
    {

        return view(
            'login'
    );
  }
  public function store(Request $request)
  {
      try {
  
          $request->validate([
              'username' => 'required|string|max:255',
              'email' => 'required|string|email|max:255|unique:users',
              'password' => 'required|string|min:8|confirmed',
              
          ]);
  
          $user = new User();
          $user->username = $request->input('username');
          $user->email = $request->input('email');
          $user->password = bcrypt($request->input('password')); 
          $user->save();
  
          
          return redirect()->route('users.index')->with('success', 'User created successfully.');
  
      } catch (\Exception $e) {
        
          Log::error('Error creating user: ' . $e->getMessage());
  
     
          return redirect()->back()->with('error', 'Failed to create user. Please try again later.');
      }
  }
  
}
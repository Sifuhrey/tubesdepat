<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


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
  
          
          return redirect()->route('login');
  
      
  }
  public function processlogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // Login berhasil
            Auth::login($user);

            return redirect()->route('orders.index')->with('success', 'Login berhasil!');
        }

        // Login gagal
        return back()->withErrors(['error' => 'Email atau password salah.']);
    }

    // Dashboard setelah login
    public function dashboard()
    {
        return view('dashboard'); // Sesuaikan dengan tampilan dashboard Anda
    }

    // Proses logout
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login.form')->with('success', 'Logout berhasil!');
    }

}
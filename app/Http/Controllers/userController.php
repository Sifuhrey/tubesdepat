<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Address; // Pastikan model Address sudah ada dan sesuai
use Illuminate\Container\Attributes\Auth as AttributesAuth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function regis()
    {
        return view('register');
    }

    public function login()
    {
        return view('login');
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
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (Auth::attempt($credentials)) {
            if ($user->username === 'admin') {
                // Redirect ke dashboard admin
                return redirect()->route('admin.main')->with('success', 'Selamat datang Admin!');
            }else {
                # code...
                return redirect()->route('user.index')->with('success', 'Login berhasil!');
            }
        }

        return back()->withErrors(['error' => 'Email atau password salah.']);
    }

    public function dashboard()
    {
        if(Auth::check()){
            return view('dashboard');
        }
  
        return redirect("login")->withSuccess('Opps! You do not have access');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil!');
    }

    // Fungsi untuk menampilkan profil pengguna
    public function profile()
    {
        $userId = Auth::id();  // Ambil data pengguna yang sedang login
        $userprofile = User::where('id_user', $userId)->get();
        
        $addresses = Address::where('id_user', $userId)->get(); // Ambil data alamat berdasarkan user_id

        return view('profile', compact('userId', 'addresses','userprofile')); // Kirim data ke view
    }
    public function edit()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();
        return view('ubahbiodata', compact('user'));
    }

    public function update(Request $request)
{
    // Validate the input data
    $validated = $request->validate([
        'username' => 'required|string|max:255',
        'birthdate' => 'nullable|date',
        'sex' => 'required|in:0,1', // 0 is male, 1 is female
    ]);

    // Find the user by ID and update their details
    $user = User::findOrFail(Auth::id()); // Ensure you're using the authenticated user's ID
    $user->username = $request->input('username');
    $user->birthdate = $request->input('birthdate');
    $user->sex = $request->input('sex');
    $user->save();

    return redirect()->route('user.profile')->with('success', 'Address updated successfully.');
    // Redirect with a success message
    }
}

<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;


class AuthController extends Controller
{
    // Show Register Form
    public function showRegister()
    {
        return view('auth.register');
    }

    // Register Logic
    public function register(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
        ]);
    
        // Debugging
        \Log::info('Email: ' . $validated['email']);
        \Log::info('Password (Hashed): ' . Hash::make($validated['password']));
    
        // Simpan data ke database
        User::create([
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);
    
        return redirect()->route('login')->with('success', 'Registration successful. Please login.');
    }
    

    

    // Show Login Form
    public function showLogin()
    {
        return view('auth.login');
    }

    // Login Logic
   
    
    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
    
        if ($user && Hash::check($request->password, $user->password)) {
            Auth::login($user);
    
            // Debugging Redirect
            return redirect()->intended('guest/dashboard')->with('success', 'Login berhasil!');
        } else {
            return redirect()->back()->with('error', 'Invalid email or password.');
        }
    }
    
    
}

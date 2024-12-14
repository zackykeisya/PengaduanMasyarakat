<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class KelolaAkunController extends Controller
{
    // Menampilkan form login
    public function index()
    {
        return view('login');
    }

    // Memproses login
    public function loginAuth(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ]);

        // Cek kredensial login
        $user = $request->only('email', 'password');

        if(Auth::attempt($user)){
            return redirect()->route('guest.dashboard');
        }else{
            return redirect()->back()->with('failed', 'gagallogin');
        }

    }

    /**
     * Show the form for creating a new resource.
     */
    public function logout()
    {
        //
        Auth::logout();
        return redirect()->route('login')->with('success', 'Anda telah logout');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}



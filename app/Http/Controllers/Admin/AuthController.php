<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required','email'],
            'password' => ['required']
        ]);


        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();


            // cek role admin
            if(Auth::user()->role !== 'admin')
            {
                Auth::logout();

                return back()->withErrors([
                    'email' => 'Akun ini bukan admin'
                ]);
            }


            return redirect()
                ->route('admin.dashboard');
        }


        return back()->withErrors([
            'email' => 'Email atau Password salah'
        ]);
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
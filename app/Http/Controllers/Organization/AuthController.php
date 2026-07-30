<?php

namespace App\Http\Controllers\Organization;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Organization;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showRegister()
{
    return view('organization.events.create');
}

public function register(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:organizations,email',
        'password' => 'required|min:6|confirmed',
    ]);

    Organization::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
    ]);

    return redirect()
        ->route('organization.login')
        ->with('success', 'Akun berhasil dibuat. Silakan login.');
}

    public function showLogin()
    {
        return view('organization.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('organization')->attempt($credentials)) {

            $request->session()->regenerate();

            return redirect()->route('organization.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('organization')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('organization.login');
    }
}
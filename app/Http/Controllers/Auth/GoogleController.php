<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    /**
     * Redirect ke Google
     */
  public function redirect(Request $request)
{
    session(['url.intended' => url()->previous()]);
    if ($request->filled('event')) {

        session([
            'redirect_after_login' => route('checkout.create', $request->event)
        ]);

        session()->save();


    }

    return Socialite::driver('google')->redirect();
}

    /**
     * Callback dari Google
     */
  public function callback()
{
    try {

        $googleUser = Socialite::driver('google')->user();

        $user = User::where('email', $googleUser->getEmail())->first();

        if (!$user) {

            $user = User::create([
                'name'      => $googleUser->getName(),
                'email'     => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
                'password'  => bcrypt(Str::random(16)),
                'role'      => 'user',
            ]);

        } else {

            $user->update([
                'google_id' => $googleUser->getId(),
                'avatar'    => $googleUser->getAvatar(),
            ]);

        }

        Auth::login($user, true);

        if (session()->has('redirect_after_login')) {

            $url = session()->pull('redirect_after_login');

            return redirect()->to($url);

        }

        return redirect()->route('welcome');

    } catch (\Throwable $e) {

        return redirect()
            ->route('welcome')
            ->with('error', $e->getMessage());

    }
}
}
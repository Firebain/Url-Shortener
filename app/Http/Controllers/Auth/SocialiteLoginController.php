<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteLoginController extends Controller
{
    protected $redirectTo = RouteServiceProvider::HOME;

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback(Request $request, $provider)
    {
        $socialite_user = Socialite::driver($provider)->user();

        $user = User::firstOrCreate([
            'email' => $socialite_user->email,
            'provider' => $provider
        ], [
            'name' => $socialite_user->name,
            'password' => Hash::make(Str::random(24)),
        ]);

        Auth::login($user, true);

        return redirect($this->redirectTo);
    }
}
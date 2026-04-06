<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();

        // Cek apakah user sudah ada berdasarkan id_google
        $user = User::where('id_google', $googleUser->getId())->first();

        if (!$user) {
            // Kalau belum ada, buat user baru
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'id_google' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)) // dummy password
            ]);
        }

        Auth::login($user);

        return redirect('/dashboard'); // sementara redirect ke home
    }
}

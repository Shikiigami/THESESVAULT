<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class SocialController extends Controller
{
    public function googleRedirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function loginWithGoogle()
    {
        try {
            $user = Socialite::driver('google')->user();
            $allowedDomain = '@psu.palawan.edu.ph';

            // Check if the user's email ends with the allowed domain
            if (Str::endsWith($user->email, $allowedDomain)) {
                $existingUser = User::where('google_id', $user->id)->first();

                if ($existingUser) {
                    Auth::login($existingUser);
                    $existingUser->update(['status' => 'active']);
                    return redirect('/dashboard');
                } else {
                    $randomPassword = bcrypt(Str::random(16));
                    $createUser = User::create([
                        'name' => $user->name,
                        'email' => $user->email,
                        'google_id' => $user->id,
                        'last_login' =>now(),
                        'password' => $randomPassword,
                    ]);

                    Auth::login($createUser);
                    $createUser->update(['status' => 'active']);
                    return redirect('/dashboard');
                }
            } else {
                return redirect('/login')->with('error', 'Login failed. Please use a valid PSU corporate email address.');
            }
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Login failed. Please try again.');
        }
    }
}

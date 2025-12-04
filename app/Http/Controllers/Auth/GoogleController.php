<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleController extends Controller
{
    // Step 1: redirect to Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Step 2: handle callback from Google
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Unable to login using Google.');
        }

        // Find user by google_id or email
        $user = User::where('google_id', $googleUser->getId())
            ->orWhere('email', $googleUser->getEmail())
            ->first();

        if (! $user) {
            // ✅ New user create with role
            $user = User::create([
                'name'         => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Google User',
                'email'        => $googleUser->getEmail(),
                'google_id'    => $googleUser->getId(),
                'password'     => bcrypt(Str::random(16)),
                'system_admin' => 'customer', // 🔥 important
            ]);
        } else {
            // Existing user holeo jodi google_id / system_admin na thake, set kore nao
            $updated = false;

            if (empty($user->google_id)) {
                $user->google_id = $googleUser->getId();
                $updated         = true;
            }

            if (empty($user->system_admin)) {
                $user->system_admin = 'customer'; // ba je role dorkar
                $updated            = true;
            }

            if ($updated) {
                $user->save();
            }
        }

        // Log the user in
        Auth::login($user, true);

        // Redirect wherever you want
        return redirect()->intended(route('home'));
    }

}

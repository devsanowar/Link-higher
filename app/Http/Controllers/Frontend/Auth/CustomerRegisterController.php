<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CustomerRegisterController extends Controller
{


    public function register()
    {
        return view('website.auth.register');
    }

    public function store(SignupRequest $request)
    {

        $data = $request->validated();

        // User তৈরি
        $user = User::create([
            'name'         => $data['name'],
            'email'        => $data['email'],
            'password'     => bcrypt($data['password']),
            'system_admin' => 'customer',
        ]);

        // সাথে সাথে লগইন
        Auth::login($user);

        // সফল হলে যেখানে নেবে সেট করো
        return redirect()->intended('/customer/dashboard')->with('success', 'Account created successfully!');
    }

    // public function logout()
    // {
    //     Auth::logout();

    //     request()->session()->invalidate();
    //     request()->session()->regenerateToken();

    //     return redirect('/')->with('success', 'Logged out!');
    // }

}

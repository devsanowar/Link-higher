<?php
namespace App\Http\Controllers\Frontend\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SignInRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerLoginController extends Controller
{
    public function signIn()
    {
        return view("website.auth.login");
    }

    public function login(SignInRequest $request)
    {
        $credentials = $request->only('email', 'password');


        if (Auth::attempt($credentials, $request->boolean('remember'))) {

            $request->session()->regenerate();

            if (Auth::user()->system_admin === 'customer') {
                return redirect()->intended('/service-page')
                    ->with('success', 'Welcome back!');
            }

            Auth::logout();
            return back()->withErrors(['email' => 'Access denied: Only customers can log in here.']);
        }

        return back()->withErrors(['email' => 'These credentials do not match our records.'])
            ->onlyInput('email');
    }

    public function logout()
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->route('customer.signin')->with('success', 'Logged out!');
    }
}

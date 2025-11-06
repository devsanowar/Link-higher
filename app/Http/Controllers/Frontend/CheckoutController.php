<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkout()
    {
        // if (! Auth::check()) {
        //     return redirect()->route('customer.register'); // অথবা customer.register
        // }

        // if (Auth::user()->system_admin === 'customer') {
        //     return view("website.checkout");
        // } else {
        //     return redirect()->route('customer.register');
        // }


        return view("website.checkout");
    }

}

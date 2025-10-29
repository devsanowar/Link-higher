<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        // 1) Not logged-in → login এ পাঠাও
        if (!Auth::check()) {
            return redirect()->guest(route('login'));
        }

        // 2) ইউজারের রোল (enum: admin, editor, user, customer)
        $userRole = strtolower(Auth::user()->system_admin ?? '');

        // 3) যদি রুটে কোনো রোল না দেয়া থাকে, allow (বা চাইলে 403 করতে পারো)
        if (empty($roles)) {
            return $next($request);
        }

        // 4) Strict check: শুধু ওই রুটে allow-list এ থাকা রোলই ঢুকবে
        //    এখানে কোনো "admin always allowed" ব্যতিক্রম নেই
        $roles = array_map('strtolower', $roles);
        if (in_array($userRole, $roles, true)) {
            return $next($request);
        }

        // 5) Wrong panel → তাদের নিজ নিজ হোমে রিডাইরেক্ট করো (বা 403)
        $homeByRole = [
            'admin'    => route('admin.dashboard'),
            // 'editor'   => route('editor.dashboard', absolute: false) ?? url('/'),
            // 'user'     => route('user.dashboard', absolute: false) ?? url('/'),
            'customer' => route('customer.dashboard'),
        ];

        // রোল মেপিং থাকলে সেদিকে পাঠাই, নাহলে 403
        if (isset($homeByRole[$userRole])) {
            return redirect($homeByRole[$userRole])
                ->with('error', 'Unauthorized for this section.');
        }

        abort(403, 'Unauthorized');
    }

}

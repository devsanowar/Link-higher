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
    public function handle(Request $request, Closure $next, ...$roles): Response
    {

        if (! Auth::check()) {
            return redirect()->guest(route('login'));
        }

        $user     = Auth::user();
        $userRole = $user->system_admin;

        if (empty($roles)) {
            return $next($request);
        }


        if ($userRole === 'admin') {
            return $next($request);
        }

        if (in_array($userRole, $roles, true)) {
            return $next($request);
        }

        abort(403, 'Unauthorized');
    }

}

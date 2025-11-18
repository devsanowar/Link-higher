<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class TrackVisitor
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $ip = $request->ip();

        // API দিয়ে IP → Country
        $info = Http::get("https://ipapi.co/{$ip}/json/")->json();

        Visitor::create([
            'ip'      => $ip,
            'country' => $info['country_name'] ?? 'Unknown',
            'city'    => $info['city'] ?? 'Unknown',
            'browser' => $request->header('User-Agent'),
            'device'  => $request->header('User-Agent'),
            'page'    => $request->path(),
        ]);

        return $next($request);
    }
}

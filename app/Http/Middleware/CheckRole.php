<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $roles
     * @return mixed
     */
   public function handle($request, Closure $next, ...$roles)
    {
        if ($request->user() && !in_array($request->user()->role, $roles)) {
            return response()->view('layouts.not-found');
        }
    
        return $next($request);
    }
}

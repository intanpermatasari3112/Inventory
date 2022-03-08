<?php
 
namespace App\Http\Middleware;
 
use Closure;
 
class CheckRole
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, ...$role)
    {
        if (!in_array(strtolower($request->user()->level), $role)) {
            return abort(403, "Anda tidak memiliki akses pada menu ini!");
        }
 
        return $next($request);
    }
 
}
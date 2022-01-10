<?php

namespace App\Http\Middleware;

use App\Models\Role;
use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        if (auth()->user()->role_id != Role::IS_ADMIN && $role == 'admin') {
            abort(403);
        }

        if (auth()->user()->role_id != Role::IS_USER && $role == 'user') {
            abort(403);
        }
        
        return $next($request);
    }
}

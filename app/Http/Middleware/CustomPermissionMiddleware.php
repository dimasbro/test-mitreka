<?php

namespace App\Http\Middleware;

use Closure;

class CustomPermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $roles = auth()->user()->roles->permissions ?? '';
        $permissions = [];
        if (! empty($roles)) {
            foreach ($roles as $per) {
                if ($per->menu_items) {
                    $permissions[] = explode('/',$per->menu_items->url)[1];
                }
            }
        }

        if (! in_array(explode('/',$_SERVER['REQUEST_URI'])[1], $permissions)) {
            abort(404);
        }

        return $next($request);
    }
}

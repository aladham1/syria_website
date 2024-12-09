<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Slides\Saml2\Models\Tenant;

class SSO
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session('logged_in')){
            if ($request->ajax()){
                return  response()->json([], 401);
            }else{
                $tenant = Tenant::where('key', 'ssoidp')->first();
                $redirectTo = saml_url($request->fullUrl(), $tenant->uuid);

                return  redirect($redirectTo);
            }
        }
        return $next($request);
    }
}

<?php

namespace RB28DETT\RB28DETT\Middleware;

use Auth;
use Closure;
use RB28DETT\RB28DETT\Injector;
use RB28DETT\RB28DETT\Packages;
use RB28DETT\Users\Models\User;

class RB28DETTAuth
{
    /**
     * Run the request filter.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure                 $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (!Auth::check()) {
            return redirect()->route('rb28dett::login')->with('warning', 'You need to log in first');
        }

        $user = User::findOrFail(Auth::id());

        if (!$user->rb28dettAccess()) {
            return redirect('/')->with('error', 'You have no rights to enter this page');
        }

        foreach (Packages::all() as $package) {
            Injector::inject('rb28dett.auth', $package);
        }

        return $next($request);
    }
}

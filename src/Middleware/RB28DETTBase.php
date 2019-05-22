<?php

namespace RB28DETT\RB28DETT\Middleware;

use Aitor24\Localizer\Middlewares\LocalizerMiddleware as Localizer;
use Closure;
use RB28DETT\RB28DETT\Injector;
use RB28DETT\RB28DETT\Packages;

class RB28DETTBase
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
        // Before request code

        foreach (Packages::all() as $package) {
            Injector::inject('rb28dett.base', $package);
        }

        // Setting locale
        $localizer = new Localizer();
        $localizer->setLang($request);

        return $next($request);
    }
}

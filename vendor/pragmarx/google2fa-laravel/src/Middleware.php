<?php

namespace PragmaRX\Google2FALaravel;

use Closure;
use PragmaRX\Google2FALaravel\Support\Authenticator;

class Middleware
{
    public function handle($request, Closure $next)
    {
        if(module_is_active('GoogleAuthentication'))
        {
            $authenticator = app(Authenticator::class)->boot($request);
            if ($authenticator->isAuthenticated()) {
                return $next($request);
            }
            return $authenticator->makeRequestOneTimePasswordResponse();
        }
        else
        {
            return $next($request);
        }

    }
}

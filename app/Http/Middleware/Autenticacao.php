<?php

namespace RELSIAFI\Http\Middleware;

use Closure;

class Autenticacao
{

    public function handle($request, Closure $next)
    {
        if ( ! $request->session()->has('autenticacao')) {
            return response(trans('info.not_login'), 401);
        }

        return $next($request);
    }
}

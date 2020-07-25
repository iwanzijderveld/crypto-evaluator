<?php

namespace Insanetlabs\CryptoEvaluator\Middleware;


use Closure;
use Illuminate\Http\Request;
use Insanetlabs\CryptoEvaluator\Models\CryptoEvaluatorUser;

class RedirectIfNotRegistered
{

    /**
     * Redirect to login page if the user is not authenticated
     *
     * @param Request $request
     * @param Closure $next
     * @return void
     */
    public function handle(Request $request, Closure $next)
    {
        if (CryptoEvaluatorUser::count() <= 0) {
            return redirect('/crypto-evaluator/register');
        }

        return $next($request);
    }
}
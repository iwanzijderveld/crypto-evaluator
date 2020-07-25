<?php

namespace Insanetlabs\CryptoEvaluator\Middleware;

/**
 * @author Iwan van Zijderveld <iwanzijderveld@gmail.com>
 * @package Insanetlabs\CryptoEvaluator
 */
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
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
        if (Auth::guard('crypto-evaluator')->check()) {
            return redirect('/crypto-evaluator/overview');
        }

        return $next($request);
    }
}
<?php

namespace Insanetlabs\CryptoEvaluator\Controllers\Auth;

/**
 * @author Iwan van Zijderveld <iwanzijderveld@gmail.com>
 * @package Insanetlabs\CryptoEvaluator
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Insanetlabs\CryptoEvaluator\Middleware\RedirectIfAuthenticated;
use Insanetlabs\CryptoEvaluator\Middleware\RedirectIfNotRegistered;

class LoginController extends BaseController
{
    use ValidatesRequests, AuthenticatesUsers;

    public function __construct()
    {
        $this->middleware(RedirectIfNotRegistered::class);
        $this->middleware(RedirectIfAuthenticated::class)->except('logout');
    }

    public function showLoginPage()
    {
        return view('crypto-evaluator::auth.login');
    }

    public function loggedOut()
    {
        return redirect('/crypto-evaluator');
    }

    protected function authenticated()
    {
        return redirect('crypto-evaluator/dashboard');
    }

    protected function guard()
    {
        return Auth::guard('crypto-evaluator');
    }
}

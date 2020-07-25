<?php

namespace Insanetlabs\CryptoEvaluator\Controllers;

/**
 * @author Iwan van Zijderveld <iwanzijderveld@gmail.com>
 * @package Insanetlabs\CryptoEvaluator
 */
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Insanetlabs\CryptoEvaluator\Middleware\RedirectIfNotAuthenticated;

class CryptoEvaluatorController extends BaseController
{
    use ValidatesRequests, AuthorizesRequests;


    public function __construct()
    {
        $this->middleware(RedirectIfNotAuthenticated::class);
    }

    public function dashboard()
    {

        return view('crypto-evaluator::maps', []);
    }

    public function overview()
    {

        return view('crypto-evaluator::overview', []);
    }
}
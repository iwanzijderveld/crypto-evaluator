<?php

namespace Insanetlabs\CryptoEvaluator\Controllers\Auth;

/**
 * @author Iwan van Zijderveld <iwanzijderveld@gmail.com>
 * @package Insanetlabs\CryptoEvaluator
*/

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Insanetlabs\CryptoEvaluator\Mails\WelcomeMail;
use Illuminate\Routing\Controller as BaseController;
use Insanetlabs\CryptoEvaluator\Models\CryptoEvaluatorUser;

class RegisterController extends BaseController
{
    use RegistersUsers;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
     */

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/crypto-evaluator/overview';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:crypto_evaluator_users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return CryptoEvaluatorUser
     */
    protected function create(array $data)
    {
        return CryptoEvaluatorUser::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    /**
     * The user has been registered.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function registered(Request $request, $user)
    {
        // send mail to the user
        Mail::to($user->email)->send(new WelcomeMail($user));
    }

    public function showRegistrationForm()
    {
        return view('crypto-evaluator::auth.first-time-setup');
    }
}

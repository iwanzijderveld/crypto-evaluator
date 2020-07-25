<?php

namespace Insanetlabs\CryptoEvaluator\Models;

/**
 * @author Iwan van Zijderveld <iwanzijderveld@gmail.com>
 * @package Insanetlabs\CryptoEvaluator
 */

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Insanetlabs\CryptoEvaluator\Notifications\ResetPasswordNotification;

class CryptoEvaluatorUser extends Authenticatable
{
    use Notifiable;

    protected $fillable = ['name', 'email', 'password'];


    public function getRememberTokenName()
    {
        return null;
    }

    /**
     * Send a password reset email to the user
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($token));
    }
}
?>
<?php 

namespace Insanetlabs\CryptoEvaluator\Models;

/**
 * @author Iwan van Zijderveld <iwanzijderveld@gmail.com>
 * @package Insanetlabs\CryptoEvaluator
 */

use Illuminate\Database\Eloquent\Model;

class CoinChange extends Model
{
    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = array(
        'created_at',
        'updated_at',
    );

    /**
     * Hidden attributes
     */
    protected $hidden = array(
        'created_at', 'updated_at'
    );

    public function coin() {
        return $this->belongsTo(Coin::class);
    }
}
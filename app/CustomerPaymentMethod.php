<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class CustomerPaymentMethod extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'customer_id',
        'payment_method_id',
        'creditCardNumber',
        'details',
    ];

    public function customer(): HasOne
    {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }
}

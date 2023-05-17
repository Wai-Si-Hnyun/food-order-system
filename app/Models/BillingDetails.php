<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BillingDetails extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_code',
        'name',
        'country',
        'state',
        'city',
        'address',
        'phone',
        'note'
    ];

    /**
     * Get the order associated with the BillingDetails
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class, 'order_code', 'order_code');
    }
}

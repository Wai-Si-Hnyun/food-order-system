<?php

namespace App\Contracts\Services;

use Illuminate\Http\Request;

interface PaymentServiceInterface
{
    /**
     * Charge function for payment with Stripe
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function chargeCard(Request $request);

    /**
     * Charge function for google pay with Stripe
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function chargeGooglePay(Request $request);
}
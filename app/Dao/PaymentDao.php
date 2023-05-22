<?php

namespace App\Dao;

use App\Contracts\Dao\PaymentDaoInterface;
use App\Models\Payment;
use Stripe\Charge;
use Stripe\Stripe;

class PaymentDao implements PaymentDaoInterface
{
    /**
     * Store payment function
     *
     * @param array $payment
     * @return \App\Models\Payment
     */
    public function store(array $payment)
    {
        return Payment::create($payment);
    }

    /**
     * Create charge function for stripe
     *
     * @param float $price
     * @param string $stripeToken
     * @return \Stripe\Charge $charge
     */
    public function createCharge(float $price, string $stripeToken)
    {
        // Set the Stripe API key
        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $charge = Charge::create([
                'amount' => $price * 100,
                'currency' => 'usd',
                'source' => $stripeToken,
                'description' => 'Test payment for food order system',
            ]);
        } catch (\Exception $e) {
            logger($e);
        }

        return $charge;
    }
}

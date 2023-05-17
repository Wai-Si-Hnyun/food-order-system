<?php

namespace App\Contracts\Dao;

interface PaymentDaoInterface
{
    /**
     * Store payment data
     *
     * @param array $data
     * @return \App\Models\Payment
     */
    public function store(array $data);

    /**
     * Create charge payment for Stripe
     *
     * @param float $price
     * @param string $stripeToken
     * @return \Stripe\Charge
     */
    public function createCharge(float $price, string $stripeToken);
}
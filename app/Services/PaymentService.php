<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Contracts\Dao\PaymentDaoInterface;
use App\Contracts\Services\PaymentServiceInterface;

class PaymentService implements PaymentServiceInterface
{
    private $paymentDao;

    public function __construct(PaymentDaoInterface $paymentDao)
    {
        $this->paymentDao = $paymentDao;
    }

    /**
     * Charge function to Stripe
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function chargeCard(Request $request)
    {
        $price = $request->input('price');

        try {
            $charge = $this->paymentDao->createCharge($price, $request->stripeToken);
            $payment_data = [
                'payment_amount' => $charge->amount,
                'payment_currency' => $charge->currency,
                'payment_method' => $charge->payment_method_details->card->brand,
                'payment_gateway' => $charge->calculated_statement_descriptor,
                'payment_status' => $charge->status,
                'transaction_id' => $charge->id
            ];

            // Store the payment data in session for payment table
            Session::put('payment_data', $payment_data);

            return true;
        } catch (\Exception $th) {
           return false;
        }
    }

    /**
     * Charge function for google pay to Stripe
     *
     * @param \Illuminate\Http\Request $request
     * @return boolean
     */
    public function chargeGooglePay(Request $request)
    {
        $price = $request->totalPrice;
        $tokenStr = $request->paymentData['paymentMethodData']['tokenizationData']['token'];
        $tokenArray = json_decode($tokenStr, true);
        $stripeToken = $tokenArray['id'];

        try {
            $charge = $this->paymentDao->createCharge($price, $stripeToken);
            $payment_data = [
                'payment_amount' => $charge->amount / 100,
                'payment_currency' => $charge->currency,
                'payment_method' => $charge->payment_method_details->card->brand,
                'payment_gateway' => $charge->calculated_statement_descriptor,
                'payment_status' => $charge->status,
                'transaction_id' => $charge->id
            ];

            // Store the payment data in session for payment table
            Session::put('payment_data', $payment_data);

            return true;
        } catch (\Exception $th) {
            return false;
        }
    }
}
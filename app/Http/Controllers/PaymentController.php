<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Get the status of the payment process.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function status(Request $request)
    {
        $paymentComplete = $request->session()->get('payment-complete', false);

        return response()->json($paymentComplete, 200);
    }
}

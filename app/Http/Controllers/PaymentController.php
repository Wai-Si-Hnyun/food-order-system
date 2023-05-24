<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Contracts\Services\PaymentServiceInterface;

class PaymentController extends Controller
{

    private $paymentService;

    /**
     * Constructor for payment controller
     *
     * @param \App\Contracts\Services\PaymentServiceInterface $paymentService
     */
    public function __construct(PaymentServiceInterface $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Go to Order Payment page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        return view('user.pages.order.payment');
    }

    /**
     * Go to Card Payment page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function card()
    {
        return view('user.pages.order.card-payment');
    }

    /**
     * Go to google pay payment page
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function google()
    {
        return view('user.pages.order.google-payment');
    }

    /**
     * Get the status of the payment process.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getStatus(Request $request)
    {
        $paymentComplete = $this->paymentService->getStatus();

        return response()->json($paymentComplete, 200);
    }

    /**
     * Set the status of the payment process
     *
     * @param boolean $status
     * @return void
     */
    public function setStatus($status)
    {
        $this->paymentService->setStatus($status);
    }

    /**
     * Charge function for Card Payment with Stripe
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chargeCard(Request $request)
    {
        $chargeResult = $this->paymentService->chargeCard($request);

        if ($chargeResult) {
            $this->setStatus(true);

            return response()->json(['success' => 'Payment successful!'], 200);
        } else {
            return response()->json(['message' => 'Invalid card details.'], 400);
        }
    }

    /**
     * Charge function for Google Pay with Stripe
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function chargeGooglePay(Request $request)
    {
        $chargeResult = $this->paymentService->chargeGooglePay($request);

        if ($chargeResult) {
            $this->setStatus(true);

            return response()->json(['message' => 'Payment successful!'], 200);
        } else {
            return response()->json(['message' => 'Invalid card details.'], 400);
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PaymobService;


class PaymentController extends Controller
{
    protected $paymobService;

    public function __construct(PaymobService $paymobService)
    {
        $this->paymobService = $paymobService;
    }

    public function createOrder(Request $request)
    {
        $orderData = [
            'delivery_needed' => false,
            'amount_cents' => 1000 * 100,
            'currency' => 'EGP',
            'merchant_order_id' => uniqid(),
            'items' => []
        ];

        $order = $this->paymobService->createOrder($orderData);
        $paymentKeyData = [
            'amount_cents' => $orderData['amount_cents'],
            'currency' => 'EGP',
            'order_id' => $order['id'],
            'billing_data' => [
                'apartment' => 'NA',
                'email' => $request->email,
                'floor' => 'NA',
                'first_name' => $request->first_name,
                'street' => 'NA',
                'building' => 'NA',
                'phone_number' => $request->phone_number,
                'shipping_method' => 'NA',
                'postal_code' => 'NA',
                'city' => 'NA',
                'country' => 'NA',
                'last_name' => $request->last_name,
                'state' => 'NA'
            ],
            'integration_id' => $this->paymobService->getIntegrationId()
        ];

        $paymentKey = $this->paymobService->createPaymentKey($paymentKeyData);

        return redirect($this->paymobService->getIframeUrl($paymentKey['token']));
    }
}

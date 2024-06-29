<?php

namespace App\Traits;

use App\Models\Order;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Resources\TransactionResource;

trait PaymentsMethod

{

    use ApiResponseTrait;
    public function isValidHmac($data)
    {
        if (!isset($data['hmac'])) {
            return false;
        }

        ksort($data);
        $hmac = $data['hmac'];
        $filteredData = $this->filterDataForHmac($data);
        $secret = env('PAYMOB_HMAC_SECRET');
        $hashed = hash_hmac('sha512', $filteredData, $secret);

        return $hashed === $hmac;
    }


    public function filterDataForHmac($data)
    {
        $keys = [
            'amount_cents', 'created_at', 'currency', 'error_occured', 'has_parent_transaction',
            'id', 'integration_id', 'is_3d_secure', 'is_auth', 'is_capture', 'is_refunded',
            'is_standalone_payment', 'is_voided', 'order', 'owner', 'pending', 'source_data_pan',
            'source_data_sub_type', 'source_data_type', 'success',
        ];

        $connectedString = '';
        foreach ($data as $key => $value) {
            if (in_array($key, $keys)) {
                $connectedString .= $value;
            }
        }

        return $connectedString;
    }

    public function processPaymentStatus($data)
    {
        if ($data['success'] == true) {
            return $this->handlePaymentSuccess($data);
        } else {
            return $this->handlePaymentFailure();
        }
    }

    public function handlePaymentSuccess($data)
    {
        $order = Order::where('merchant_order_id', request('merchant_order_id'))->first();
        $order->update(['type' => 'order' , 'status' => 'payment']);
        return $this->ApiResponse(new TransactionResource($data), transWord('تمت عملية الدفع بنجاح'));
    }

    public function handlePaymentFailure()
    {
        return $this->ApiResponse(null, transWord('فشلت عملية الدفع'), 400);
    }

    public function updateCart($cart, $request, $payment)
    {
        $cart->update([
            'phone' => $request->phone,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,

            'payment_method' => $payment->name_en,
            'payment_id' => $payment->id,
            'merchant_order_id' => uniqid(),
        ]);
    }

    public function prepareOrderData($cart, $request)
    {
        $items = $cart->orderItems->map(function ($item) {
            return [
                'name' => $item->course_name,
                'amount_cents' => $item->price * 100,
            ];
        })->toArray();
        return [
            'delivery_needed' => false,
            'amount_cents' => $cart->price_after_discount * 100, // Consider fetching this from $cart or calculating dynamically
            'currency' => 'EGP',
            'merchant_order_id' => $cart->merchant_order_id,
            'items' => $items,
        ];
    }

    public function preparePaymentKeyData($orderData, $request, $order)
    {
        return [
            'amount_cents' => $orderData['amount_cents'],
            'currency' => 'EGP',
            'order_id' => $order['id'],
            'billing_data' => [
                'apartment' => 'NA',
                'floor' => 'NA',
                'email' => $request->email,
                'first_name' => $request->first_name,
                'street' => $request->address,
                'building' => 'NA',
                'phone_number' => $request->phone,
                'shipping_method' => 'NA',
                'postal_code' => $request->postal_code ?? 'NA',
                'city' => $request->city,
                'country' => $request->country,
                'last_name' => $request->last_name,
                'state' => $request->state ?? 'NA',
            ],
            'integration_id' => $this->paymobService->getIntegrationId(),
        ];
    }

    public function getCart()
    {
        return auth()->user()->cart;
    }


}

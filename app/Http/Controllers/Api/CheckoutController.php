<?php

namespace App\Http\Controllers\Api;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use App\Traits\PaymentsMethod;
use App\Services\PaymobService;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Http;
use App\Http\Resources\Api\CartResource;
use App\Http\Resources\PaymentsResource;
use App\Http\Requests\Api\CheckoutRequest;
use App\Http\Controllers\Api\Traits\ApiResponseTrait;

class CheckoutController extends Controller
{
    use ApiResponseTrait, PaymentsMethod;
    protected $paymobService;

    public function __construct(PaymobService $paymobService)
    {
        $this->paymobService = $paymobService;
    }

    public function index()
    {
        $cart = auth()->user()->cart;
        $payment = Payment::where('is_active', 1)->get();
        return $this->ApiResponse([
            'id' => $cart->id,
            'order_number' => $cart->order_number,
            'status' => $cart->status,
            'cart' => CartResource::collection($cart->orderItems),
            'total_price' => $cart->total_price,
            'total_discount' => $cart->discount,
            'coupon_price' => $cart->coupon_price ?? 0,
            'coupon_code' => $cart->coupon_code ?? null,
            'price_after_discount' => $cart->price_after_discount,



        ], '', 200);
    }
    public function payments()
    {
        $payment = Payment::where('is_active', 1)->get();
        return $this->ApiResponse(PaymentsResource::collection($payment));
    }

    public function store(CheckoutRequest $request)
    {
        $payment = Payment::find($request->payment_id);

        if (!$payment) {
            return $this->ApiResponse(null, transWord('Payment method not found.'), 404);
        }

        $cart = $this->getCart();

        if (!$cart) {
            return $this->ApiResponse(null, transWord('Unable to process the order.'), 404);
        }

        $this->updateCart($cart, $request, $payment);

        $orderData = $this->prepareOrderData($cart, $request);
        $order = $this->paymobService->createOrder($orderData);

        $paymentKeyData = $this->preparePaymentKeyData($orderData, $request,  $order);
        $paymentKey = $this->paymobService->createPaymentKey($paymentKeyData);

        return $this->ApiResponse($this->paymobService->getIframeUrl($paymentKey['token'], $payment->iframeId));
    }

    public function callback(Request $request)
    {
        $data = $request->all();


        if (!$this->isValidHmac($data)) {
            return $this->handlePaymentFailure();
        }

        return $this->processPaymentStatus($data);
    }

    // {

    //     $data = $request->all();

    //     ksort($data);
    //     $hmac = $data['hmac'];
    //     $array = [
    //         'amount_cents',
    //         'created_at',
    //         'currency',
    //         'error_occured',
    //         'has_parent_transaction',
    //         'id',
    //         'integration_id',
    //         'is_3d_secure',
    //         'is_auth',
    //         'is_capture',
    //         'is_refunded',
    //         'is_standalone_payment',
    //         'is_voided',
    //         'order',
    //         'owner',
    //         'pending',
    //         'source_data_pan',
    //         'source_data_sub_type',
    //         'source_data_type',
    //         'success',
    //     ];
    //     $connectedString = '';
    //     foreach ($data as $key => $element) {
    //         if (in_array($key, $array)) {
    //             $connectedString .= $element;
    //         }
    //     }
    //     $secret = env('PAYMOB_HMAC');
    //     $hased = hash_hmac('sha512', $connectedString, $secret);
    //     if ($hased == $hmac) {
    //         dd($data);
    //         echo "secure";
    //         exit;
    //     }
    //     echo 'not secure';
    //     exit;
    // }


    // public function credit()
    // {

    //     $token = $this->getToken();
    //     $order = $this->createOrder($token);
    //     $paymentToken = $this->getPaymentToken($order, $token);
    //     return \Redirect::away('https://accept.paymobsolutions.com/api/acceptance/iframes/' . env('PAYMOB_IFRAME_ID') . '?payment_token=' . $paymentToken);
    // }

    // public function getToken()
    // {
    //     $response = Http::post('https://accept.paymob.com/api/auth/tokens', [
    //         "api_key" => env('PAYMOB_API_KEY')
    //     ]);
    //     return $response->object()->token;
    // }


    // public function createOrder($token)
    // {
    //     $order_data = Order::find(16);

    //     //  dd($order->orderItems);
    //     $items = [];
    //     foreach ($order_data->orderItems as $item) {
    //         $items[] = [
    //             "name" => $item->course_name,
    //             "amount_cents" => $item->price,

    //         ];
    //     }

    //     $data = [
    //         "auth_token" =>   $token,
    //         "delivery_needed" => "false",
    //         "amount_cents" => $order_data->price_after_discount * 100,
    //         "currency" => "EGP",
    //         "items" => $items,
    //         //    "merchant_order_id" => $order_data->id


    //     ];
    //     $response = Http::post('https://accept.paymob.com/api/ecommerce/orders', $data);
    //     return $response->object();
    // }

    // public function getPaymentToken($order, $token)
    // {

    //     $billingData = [
    //         "apartment" => "803",
    //         "email" => "claudette09@exa.com",
    //         "floor" => "42",
    //         "first_name" => "Clifford",
    //         "street" => "Ethan Land",
    //         "building" => "8028",
    //         "phone_number" => "+86(8)9135210487",
    //         "shipping_method" => "PKG",
    //         "postal_code" => "01898",
    //         "city" => "Jaskolskiburgh",
    //         "country" => "CR",
    //         "last_name" => "Nicolas",
    //         "state" => "Utah"
    //     ];
    //     $data = [
    //         "auth_token" => $token,
    //         "amount_cents" => $order->amount_cents,
    //         "expiration" => 3600,
    //         "order_id" => $order->id,
    //         "billing_data" => $billingData,
    //         "currency" => "EGP",
    //         "integration_id" => env('PAYMOB_INTEGRATION_ID')
    //     ];
    //     $response = Http::post('https://accept.paymob.com/api/acceptance/payment_keys', $data);
    //     return $response->object()->token;
    // }

    // public function callback(Request $request)
    // {

    //     $data = $request->all();

    //     ksort($data);
    //     $hmac = $data['hmac'];
    //     $array = [
    //         'amount_cents',
    //         'created_at',
    //         'currency',
    //         'error_occured',
    //         'has_parent_transaction',
    //         'id',
    //         'integration_id',
    //         'is_3d_secure',
    //         'is_auth',
    //         'is_capture',
    //         'is_refunded',
    //         'is_standalone_payment',
    //         'is_voided',
    //         'order',
    //         'owner',
    //         'pending',
    //         'source_data_pan',
    //         'source_data_sub_type',
    //         'source_data_type',
    //         'success',
    //     ];
    //     $connectedString = '';
    //     foreach ($data as $key => $element) {
    //         if (in_array($key, $array)) {
    //             $connectedString .= $element;
    //         }
    //     }
    //     $secret = env('PAYMOB_HMAC');
    //     $hased = hash_hmac('sha512', $connectedString, $secret);
    //     if ($hased == $hmac) {
    //         dd($data);
    //         echo "secure";
    //         exit;
    //     }
    //     echo 'not secure';
    //     exit;
    // }
}

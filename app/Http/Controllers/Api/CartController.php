<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use App\Models\Course;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CartResource;
use App\Models\Coupon;

class CartController extends Controller
{
    public function index()
    {
        $cart = auth()->user()->cart;


        if (!$cart) {
            return $this->ApiResponse(null, transWord('سلة المشتريات فارغة'), 404);
        }
        $totalPrice = $cart->orderItems->sum('price');
        $totalDiscount = $cart->orderItems->sum('discount');
        $totalPriceAfterDiscount = $cart->orderItems->sum('price_after_discount');


        // $cart->update([
        //     'total_price' => $totalPrice,
        //     'discount' => $totalDiscount,
        //     'price_after_discount' => $totalPriceAfterDiscount
        // ]);

        if ($cart->coupon_price) {
            $cart->price_after_discount = max(0, $cart->price_after_discount - $cart->coupon_price);
        }

        return $this->ApiResponse([
            'cart' => CartResource::collection($cart->orderItems),
            'total_price' => $cart->total_price,
            'total_discount' => $cart ->discount,
            'price_after_discount' => $cart ->price_after_discount,
            'coupon_price' => $cart->coupon_price ?? 0,
            'coupon_code' => $cart->coupon_code ?? null,

        ], '', 200);


        // return $this->ApiResponse(CartResource::collection($cart->orderItems));
    }

    public function add($id)
    {

        $course = Course::find($id);

        if (!$course) {
            return $this->ApiResponse(null, transWord('هذه الدورة غير موجودة'), 404);
        }

        //make order type cart
        $cart = auth()->user()->cart()->firstOrCreate(
            [
                'user_id' => auth()->id(),
                'status' => 'pocessing',
                'type' => 'cart'

            ],
            [
                'order_number' => 'ORD-' . uniqid(),
                'status' => 'pocessing',
                'first_name' => auth()->user()->first_name,
                'last_name' => auth()->user()->last_name,
                'email' => auth()->user()->email,
                'phone' => auth()->user()->phone,


            ]
        );


        if ($cart->orderItems()->where('course_id', $course->id)->exists()) {
            return $this->ApiResponse(null, transWord('هذه الدورة موجودة بالفعل في سلة المشتريات'));
        }


        $cart->orderItems()->create([
            'course_id' => $course->id,
            'price' => $course->price,
            'course_name' => $course->title,
            'discount' => $course->discount,
            'price_after_discount' => $course->price_after_discount,


        ]);
        $totalPrice = $cart->price_before_discount + $course->totalPrice;
        $cart->update([
            'price_before_discount' => $totalPrice,

        ]);
        return $this->ApiResponse(null, transWord('تمت الاضافة بنجاح'));
    }

    public function remove($id)
    {
        $cart = auth()->user()->cart;
        $course = Course::find($id);

        if (!$course) {
            return $this->ApiResponse(null, transWord('هذه الدورة غير موجودة'), 404);
        }


        $itme = $cart->orderItems()->where('course_id', $course->id)->first();

        if (!$itme) {
            return $this->ApiResponse(null, transWord('هذه الدورة غير موجودة في سلة المشتريات'), 404);
        }

        $itme->delete();

        return $this->ApiResponse(null, transWord('تمت الازالة بنجاح'));
    }

    public function coupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required'
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)->where('is_active', 1)->first();

        if (!$coupon) {
            return $this->ApiResponse(null, transWord('هذا الكوبون غير صالح'), 404);
        }

        $cart = auth()->user()->cart;



        if (!$cart) {
            return $this->ApiResponse(null, transWord('سلة المشتريات فارغة'), 404);
        }


        if ($cart->coupon_id || $cart->coupon_code) {
            return $this->ApiResponse(null, transWord('لا يمكن استخدام اكثر من كوبون واحد'), 400);
        }
        $totalPriceAfterDiscount = $cart->orderItems->sum('price_after_discount') - $coupon->value;

        $cart->update([
            'coupon_id' => $coupon->id,
            'coupon_code' => $coupon->code,
            'coupon_price' => $coupon->value,

        ]);

        $coupon->increment('used');

        return $this->ApiResponse(null, transWord('تمت استخدام الكوبون بنجاح'));
    }
}

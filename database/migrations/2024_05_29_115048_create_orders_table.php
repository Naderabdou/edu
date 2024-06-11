<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number'); //
            $table->enum('status', [ 'pocessing', 'payment', 'completed'])->default('pocessing');
            $table->enum('type', ['order', 'cart'])->default('cart'); //نوع الطلب
            $table->integer('total_price'); //السعر الكلي
            $table->string('discount')->nullable();
            $table->string('price_befor_discount')->nullable();
            $table->string('coupon_code')->nullable();
            $table->string('coupon_price')->nullable();
            $table->foreignId('coupon_id')->nullable()->constrained('coupons')->onDelete('set null'); //العنوان
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null'); //العنوان
            $table->string('payment_method')->nullable(); //طريقة الدفع
            // $table->foreignId('user_id')->constrained('users')->onDelete('set null'); //المستخدم الذي قام بالطلب
         //   $table->foreignId('payment_id')->nullable()->constrained('payments')->onDelete('set null'); //المستخدم الذي قام بالطلب

            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('phone')->nullable();

            //العنوان
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

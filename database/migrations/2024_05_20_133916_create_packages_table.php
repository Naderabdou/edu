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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('name_en')->nullable();
            $table->string('name_ar')->nullable();
            $table->decimal('price', 10, 2)->default(0.00);
            $table->enum('type',['monthly','yearly'])->default('monthly');
            $table->text('features_en')->nullable();
            $table->text('features_ar')->nullable();
            $table->text('flaw_en')->nullable();
            $table->text('flaw_ar')->nullable();
        //    $table->integer('duration')->default(1);
            $table->boolean('is_active')->default(1);

          //  $table->date('expiry_date')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};

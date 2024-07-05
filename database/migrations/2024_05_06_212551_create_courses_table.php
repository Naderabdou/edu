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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            // Course Information
            $table->string('title_en')->nullable();
            $table->string('title_ar')->nullable();
            $table->string('slug_ar')->unique()->nullable();
            $table->string('slug_en')->unique()->nullable();
            $table->text('about_en')->nullable();
            $table->text('about_ar')->nullable();

            $table->boolean('is_active')->default(true)->nullable();
            $table->integer('max_students')->default(100)->nullable();
            $table->enum('level', ['beginner', 'intermediate', 'advanced','expert'])->default('beginner')->nullable();
            $table->boolean('is_public')->default(false)->nullable();
            $table->boolean('is_qa_enabled')->default(false)->nullable();

            $table->boolean('is_content_drip_enabled')->default(false)->nullable();
            //Content Drip Type
            $table->enum('content_drip_type', ['Scheduled', 'Post_Enrollment', 'Sequential','Prerequisite_Unlocked'])->nullable();
            $table->enum('type_course', ['free', 'paid'])->default('free')->nullable();
            $table->string('price', )->default(0);
            $table->string('discount', )->default(0)->nullable();
            $table->string('price_after_discount', )->default(0)->nullable();

          //  $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            $table->foreignId('instructor_id')->nullable()->constrained('users')->nullOnDelete();

            $table->string('image')->nullable();

            $table->string('intro_video')->nullable();
            $table->enum('intro_video_type', ['youtube', 'vimeo', 'upload'])->default('youtube')->nullable();
            // $table->string('topic_name_ar')->nullable();
            // $table->string('topic_name_en')->nullable();
            // $table->string('topic_desc_ar')->nullable();
            // $table->string('topic_desc_en')->nullable();


            //Additional Information
            $table->date('start_date')->nullable();
            $table->string('language')->nullable();
       //     $table->enum('language', ['english' , 'arabic' , 'japan','hindi','frence','garmani'] )->default('english');
            $table->text('requirements_en')->nullable();
            $table->text('requirements_ar')->nullable();
            $table->text('desc_en')->nullable();
            $table->text('desc_ar')->nullable();

            $table->integer('duration_hours')->default(0);

            $table->integer('duration_minutes')->default(0);

            $table->string('tags')->nullable();
            $table->string('target_audience')->nullable();
            $table->enum('status', ['pending', 'publish', 'draft'])->default('pending')->nullable();


          // $table->string('certificate_template')->nullable();






            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};

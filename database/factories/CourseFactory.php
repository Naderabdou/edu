<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title_ar' => $this->faker->sentence,
            'title_en' => $this->faker->sentence,
            'slug_en' => $this->faker->unique()->slug,
            'about_ar' => $this->faker->sentence,
            'about_en' => $this->faker->sentence,
            'is_active' => $this->faker->boolean,
            'max_students' => $this->faker->randomNumber(),
            'level' => $this->faker->randomElement(['beginner', 'intermediate', 'advanced','expert']),
            'is_public' => $this->faker->boolean,
            'is_qa_enabled' => $this->faker->boolean,
            'is_content_drip_enabled' => $this->faker->boolean,
            'content_drip_type' => $this->faker->randomElement(['Scheduled', 'Post_Enrollment', 'Sequential','Prerequisite_Unlocked']),
            'type_course' => $this->faker->randomElement(['free', 'paid']),
            'price' => $this->faker->randomFloat(2, 0, 100),
            'discount' => $this->faker->randomFloat(2, 0, 100),
            'price_after_discount' => $this->faker->randomFloat(2, 0, 100),
           // 'instructor_id' => $this->faker->randomNumber(),
            'image' => $this->faker->imageUrl(),
            'intro_video' => $this->faker->url,
            'intro_video_type' => $this->faker->randomElement(['youtube', 'vimeo', 'upload']),
            'start_date' => $this->faker->date(),
            'language' => $this->faker->randomElement(['english' , 'arabic' , 'japan','hindi','frence','garmani']),
            'requirements_en' => $this->faker->sentence,
            'requirements_ar' => $this->faker->sentence,
            'desc_en' => $this->faker->sentence,
            'desc_ar' => $this->faker->sentence,
            'duration_hours' => $this->faker->randomNumber(),
            'duration_minutes'  => $this->faker->randomNumber(),
            'tags' => $this->faker->sentence,
            'target_audience' => $this->faker->sentence,

            'status' => $this->faker->randomElement(['pending', 'publish', 'draft']),

        ];
    }
}

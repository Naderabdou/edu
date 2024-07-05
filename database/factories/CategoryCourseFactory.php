<?php

namespace Database\Factories;

use App\Models\Course;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CategoryCourse>
 */
class CategoryCourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => function () {
                // Option 1: Use an existing Instructor's ID. Make sure you have at least one Instructor in your database.
                return Category::get()->random()->id;
                // Option 2: Create a new Instructor and use its ID. This will insert a new Instructor into the database each time a Course is created.
                // return Instructor::factory()->create()->id;
            },

            'course_id' => function () {
                // Option 1: Use an existing Instructor's ID. Make sure you have at least one Instructor in your database.
                return Course::get()->random()->id;
                // Option 2: Create a new Instructor and use its ID. This will insert a new Instructor into the database each time a Course is created.
                // return Instructor::factory()->create()->id;
            },
        ];
    }
}

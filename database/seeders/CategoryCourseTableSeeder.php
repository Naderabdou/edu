<?php

namespace Database\Seeders;

use App\Models\CategoryCourse;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoryCourseTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       CategoryCourse::factory(100)->create();
    }
}

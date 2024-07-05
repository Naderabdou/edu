<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Assuming you have roles like 'admin', 'editor', 'viewer' etc.
        $roles = ['student', 'instructor']; // Add your roles here

        User::factory(100)->create()->each(function ($user) use ($roles) {
            // Assign a random role to each user
            $randomRole = $roles[array_rand($roles)];
            $user->assignRole($randomRole);
        });
    }
}

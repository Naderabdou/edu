<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'public_name' => $this->faker->name,
            'username' => $this->faker->unique()->userName,
            'phone' => $this->faker->phoneNumber,
            'password' => 'secret', // or use Hash::make('secret'),
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'skills' => $this->faker->sentence,
            'bio' => $this->faker->sentence,
            'avatar' => $this->faker->imageUrl(),
            'background_image' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(['active']),
            'user_type' => $this->faker->randomElement(['instructor', 'student']),
            'facebook' => $this->faker->url,
            'twitter' => $this->faker->url,
            'linkedin' => $this->faker->url,
            'website' => $this->faker->url,
            'github' => $this->faker->url,
            'remember_token' => Str::random(10),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

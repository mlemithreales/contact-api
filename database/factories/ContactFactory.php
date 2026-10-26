<?php

namespace Database\Factories;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContactFactory extends Factory
{
    protected $model = Contact::class;

    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'user_id' => User::factory(),
            'phone_number' => fake()->phoneNumber(),
            'address' => fake()->address(),
            'email' => fake()->unique()->safeEmail(),
            'avatar' => fake()->optional()->imageUrl(),
        ];
    }
}

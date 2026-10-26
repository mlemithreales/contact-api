<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\User;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::where('email', 'test@example.com')->first();

        if ($user) {
            Contact::factory()
                ->count(3)
                ->create(['user_id' => $user->id]);
        }
    }
}

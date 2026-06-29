<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        collect([
            ['name' => 'Test User', 'email' => 'test@example.com'],
            ['name' => 'Alex Doe', 'email' => 'alex@example.com'],
            ['name' => 'Sam Roe', 'email' => 'sam@example.com'],
        ])->each(fn (array $data) => User::firstOrCreate(
            ['email' => $data['email']],
            ['name' => $data['name'], 'password' => 'password', 'email_verified_at' => now()],
        ));
    }
}

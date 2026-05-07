<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class TestDataSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ])->assignRole('admin');

        $roles = ['guest', 'manager', 'admin'];

        User::factory(15)
            ->create()
            ->each(function ($user) use ($roles) {
                $index = fake()->numberBetween(0, 2);
                $user->assignRole($roles[$index]);
            });

        $this->call([
            TestCustomerSeeder::class
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolesAndPermissionsSeeder::class);

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
            CustomerSeeder::class
        ]);
    }
}

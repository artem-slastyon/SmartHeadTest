<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ticket>
 */
class TicketFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'subject' => fake()->text(),
            'text' => fake()->text(300),
            'status' => fake()->numberBetween(0, 2),
            'created_at' => fake()->dateTimeThisYear(),
        ];
    }
}

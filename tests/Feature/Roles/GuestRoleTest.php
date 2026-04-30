<?php

namespace Tests\Feature\Roles;

use App\Models\Ticket;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuestRoleTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed();

        $this->user = User::factory()->create();
    }

    public function testTicketsSee(): void
    {
        $response = $this->actingAs($this->user)->get(route('tickets.index'));
        $response->assertForbidden();
    }

    public function testTicketMark(): void
    {
        $ticket = Ticket::first();
        $response = $this->actingAs($this->user)->post(
            route('tickets.mark', ['id' => $ticket->id])
        );

        $response->assertForbidden();
    }

    public function testTicketEdit(): void
    {
        $ticket = Ticket::first();
        $response = $this->actingAs($this->user)
            ->patch(
                route(
                    'tickets.update',
                    ['ticket' => $ticket],
                ),
                [
                    'status' => fake()->numberBetween(0, 2),
                ]
            );

        $response->assertForbidden();
    }

    public function testTicketDelete(): void
    {
        $ticket = Ticket::first();
        $response = $this->actingAs($this->user)
            ->delete(route('tickets.destroy', ['ticket' => $ticket]));

        $response->assertForbidden();
    }

    public function testUsersSee(): void
    {
        $response = $this->actingAs($this->user)
            ->get(route('users.index'));

        $response->assertForbidden();
    }

    public function testUserEdit(): void
    {
        $roles = ['guest', 'manager', 'admin'];
        $index = fake()->numberBetween(0, 2);

        $user = User::first();
        $response = $this->actingAs($this->user)
            ->patch(
                route('users.update', ['user' => $user]),
                [
                    'role' => $roles[$index],
                ]
            );

        $response->assertForbidden();
    }

    public function testUserRemove(): void
    {
        $user = User::whereNot('id', $this->user->id)->first();
        $response = $this->actingAs($this->user)
            ->delete(
                route('users.destroy', ['user' => $user])
            );

        $response->assertForbidden();
    }
}

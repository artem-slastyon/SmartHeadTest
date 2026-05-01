<?php

namespace Tests\Feature;

use App\Enums\TicketStatus;
use App\Models\Customer;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StatisticTest extends TestCase
{
    use RefreshDatabase;

    public function testStatistic()
    {
        $customerCount = 5;
        $ticketsPerCustomer = 15;

        $dayAgo = Carbon::now()->addDays(-1);
        $weekAgo = Carbon::now()->addWeeks(-1);
        $monthAgo = Carbon::now()->addMonths(-1);

        Customer::factory()
            ->count($customerCount)
            ->hasTickets($ticketsPerCustomer)
            ->create();

        $resolved = Ticket::where('status', TicketStatus::RESOLVED)->count();

        $response = $this->get(route('api.tickets.statistics'))
            ->assertJsonPath('total', $customerCount * $ticketsPerCustomer)
            ->assertJsonPath('resolved', $resolved);

        $totalPerDay = Ticket::where('created_at', '>=', $dayAgo)->count();
        $resolvedPerDay = Ticket::where('created_at', '>=', $dayAgo)
            ->where('status', TicketStatus::RESOLVED)->count();

        $response->assertJsonPath('perDay.total', $totalPerDay);
        $response->assertJsonPath('perDay.resolved', $resolvedPerDay);

        $totalPerWeek = Ticket::where('created_at', '>=', $weekAgo)->count();
        $resolvedPerWeek = Ticket::where('created_at', '>=', $weekAgo)
            ->where('status', TicketStatus::RESOLVED)->count();

        $response->assertJsonPath('perWeek.total', $totalPerWeek);
        $response->assertJsonPath('perWeek.resolved', $resolvedPerWeek);

        $totalPerMonth = Ticket::where('created_at', '>=', $monthAgo)->count();
        $resolvedPerMonth = Ticket::where('created_at', '>=', $monthAgo)
            ->where('status', TicketStatus::RESOLVED)->count();

        $response->assertJsonPath('perMonth.total', $totalPerMonth);
        $response->assertJsonPath('perMonth.resolved', $resolvedPerMonth);
    }
}

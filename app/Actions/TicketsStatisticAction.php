<?php

namespace App\Actions;

use App\DTOs\Statistic\StatisticPerTimeData;
use App\DTOs\Statistic\TicketsStatisticData;
use App\Enums\TicketStatus;
use App\Models\Ticket;
use Carbon\Carbon;

class TicketsStatisticAction
{
    public function execute(): TicketsStatisticData
    {
        $total = Ticket::count();
        $resolved = Ticket::withStatus(TicketStatus::RESOLVED)->count();

        $dayAgo = Carbon::now()->addDays(-1);
        $weekAgo = Carbon::now()->addWeeks(-1);
        $monthAgo = Carbon::now()->addMonths(-1);

        $totalPerDay = Ticket::whereWasCreatedAfter($dayAgo)->count();
        $resolvedPerDay = Ticket::whereWasCreatedAfter($dayAgo)->withStatus(TicketStatus::RESOLVED)->count();

        $totalPerWeek = Ticket::whereWasCreatedAfter($weekAgo)->count();
        $resolvedPerWeek = Ticket::whereWasCreatedAfter($weekAgo)->withStatus(TicketStatus::RESOLVED)->count();

        $totalPerMonth = Ticket::whereWasCreatedAfter($monthAgo)->count();
        $resolvedPerMonth = Ticket::whereWasCreatedAfter($monthAgo)->withStatus(TicketStatus::RESOLVED)->count();

        return new TicketsStatisticData(
            $total,
            $resolved,
            new StatisticPerTimeData(
                $totalPerDay,
                $resolvedPerDay
            ),
            new StatisticPerTimeData(
                $totalPerWeek,
                $resolvedPerWeek
            ),
            new StatisticPerTimeData(
                $totalPerMonth,
                $resolvedPerMonth
            )
        );
    }
}

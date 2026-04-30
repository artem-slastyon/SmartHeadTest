<?php

namespace App\DTOs\Statistic;

readonly class TicketsStatisticData
{
    public function __construct(
        public int $total,
        public int $resolved,
        public StatisticPerTimeData $perDay,
        public StatisticPerTimeData $perWeek,
        public StatisticPerTimeData $perMonth,
    ) {
    }
}

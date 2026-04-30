<?php

namespace App\DTOs\Statistic;

readonly class StatisticPerTimeData
{
    public function __construct(
        public int $totalCreated,
        public int $totalResolved,
    ) {
    }
}

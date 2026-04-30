<?php

namespace App\Mappers;

use App\DTOs\Statistic\StatisticPerTimeData;
use App\DTOs\Statistic\TicketsStatisticData;

class TicketStatisticMapper
{
    public static function fromDto(TicketsStatisticData $dto): array
    {
        return [
            'total' => $dto->total,
            'resolved' => $dto->resolved,
            'perDay' => self::mapStatisticPerTime($dto->perDay),
            'perWeek' => self::mapStatisticPerTime($dto->perWeek),
            'perMonth' => self::mapStatisticPerTime($dto->perMonth)
        ];
    }

    private static function mapStatisticPerTime(StatisticPerTimeData $perTimeData): array
    {
        return [
            'total' => $perTimeData->totalCreated,
            'resolved' => $perTimeData->totalResolved,
        ];
    }
}

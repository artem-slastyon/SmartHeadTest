<?php

namespace App\Enums;

enum TicketStatus: int
{
    case NEW = 0;
    case IN_PROGRESS = 1;
    case RESOLVED = 2;

    public function color(): string
    {
        return match ($this) {
            self::NEW => 'cyan',
            self::IN_PROGRESS => 'orange',
            self::RESOLVED => 'green',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::NEW => 'New',
            self::IN_PROGRESS => 'In progress',
            self::RESOLVED => 'Resolved',
        };
    }
}

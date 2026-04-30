<?php

namespace App\Enums;

use App\Enums\Interfaces\BadgeRenderableInterface;

enum TicketStatus: int implements BadgeRenderableInterface
{
    case NEW = 0;
    case IN_PROGRESS = 1;
    case RESOLVED = 2;

    public function color(): string
    {
        return match ($this) {
            self::NEW => 'primary',
            self::IN_PROGRESS => 'warning',
            self::RESOLVED => 'success',
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

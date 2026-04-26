<?php

namespace App\Enums;

enum TicketStatus: int
{
    case NEW = 0;
    case IN_PROGRESS = 1;
    case RESOLVED = 2;
}

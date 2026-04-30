<?php

namespace App\Enums;

use App\Enums\Interfaces\BadgeRenderableInterface;

enum UserRole: string implements BadgeRenderableInterface
{
    case GUEST = 'guest';
    case MANAGER = 'manager';
    case ADMIN = 'admin';

    public function color(): string
    {
        return match ($this) {
            self::GUEST => 'success',
            self::MANAGER => 'primary',
            self::ADMIN => 'danger',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::GUEST => 'Guest',
            self::MANAGER => 'Manager',
            self::ADMIN => 'Admin',
        };
    }
}

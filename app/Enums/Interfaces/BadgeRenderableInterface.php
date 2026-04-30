<?php

namespace App\Enums\Interfaces;

interface BadgeRenderableInterface
{
    public function color(): string;
    public function label(): string;
}

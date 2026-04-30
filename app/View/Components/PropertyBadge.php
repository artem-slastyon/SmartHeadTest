<?php

namespace App\View\Components;

use App\Enums\Interfaces\BadgeRenderableInterface;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PropertyBadge extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public BadgeRenderableInterface $enum
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.property-badge');
    }
}

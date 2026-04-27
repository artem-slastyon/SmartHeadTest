<?php

namespace App\View\Components;

use App\Enums\TicketStatus;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public TicketStatus $status
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.status-badge');
    }
}

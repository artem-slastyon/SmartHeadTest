<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\View\Component;

class TicketsTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public AbstractPaginator $tickets,
        public string $emailFilter,
        public string $phoneFilter,
        public int $statusFilter,
        public string $dateFrom,
        public string $dateTo,
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tickets-table');
    }
}

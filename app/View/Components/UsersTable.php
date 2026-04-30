<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\AbstractPaginator;
use Illuminate\View\Component;

class UsersTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public AbstractPaginator $users
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.users-table');
    }
}

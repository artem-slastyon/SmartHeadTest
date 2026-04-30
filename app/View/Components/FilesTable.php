<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Spatie\MediaLibrary\MediaCollections\Models\Collections\MediaCollection;

class FilesTable extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public MediaCollection $attachments
    ) {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.files-table');
    }
}

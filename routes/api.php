<?php

use App\Http\Controllers\Api\TicketsController;
use Illuminate\Support\Facades\Route;

Route::resource('tickets', TicketsController::class)
    ->middleware(['throttle:tickets']);

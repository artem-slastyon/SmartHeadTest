<?php

use App\Http\Controllers\Api\TicketsController;
use Illuminate\Support\Facades\Route;

Route::post('/tickets', [TicketsController::class, 'store'])
    ->middleware(['throttle:tickets'])
    ->name('api.tickets.create');

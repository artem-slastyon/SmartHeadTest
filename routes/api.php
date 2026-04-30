<?php

use App\Http\Controllers\Api\TicketsController;
use Illuminate\Support\Facades\Route;

Route::post('/tickets', [TicketsController::class, 'store'])
    ->middleware(['throttle:tickets'])
    ->name('api.tickets.create');

Route::get('/tickets/statistics', [TicketsController::class, 'statistics'])
    ->name('api.tickets.statistics');

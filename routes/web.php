<?php

use App\Http\Controllers\TicketsController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/tickets');

Route::resource('/tickets', TicketsController::class);

Route::get('/widget', [WidgetController::class, 'index']);

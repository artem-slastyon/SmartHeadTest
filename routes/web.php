<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::get('/', [App\Http\Controllers\TicketsController::class, 'index'])->name('tickets');

<?php

use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/tickets');

Route::get('/tickets', [App\Http\Controllers\TicketsController::class, 'index'])->name('tickets');

<?php

use App\Http\Controllers\TicketsController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/tickets');

Route::resource('/tickets', TicketsController::class);

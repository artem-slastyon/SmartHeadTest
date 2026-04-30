<?php

use App\Http\Controllers\MediaDownloadController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/tickets');

Route::resource('/tickets', TicketsController::class);
Route::resource('tickets', TicketsController::class);

Route::get('/widget', [WidgetController::class, 'index']);

Route::get('/download/{id}', [MediaDownloadController::class, 'index'])->name('download');

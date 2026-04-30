<?php

use App\Http\Controllers\MediaDownloadController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

Auth::routes();

Route::redirect('/', '/tickets');
Route::resource('tickets', TicketsController::class)
    ->middleware('can:see tickets');

Route::post('/tickets/{id}/mark', [TicketsController::class, 'markReplied'])
    ->middleware('can:edit tickets')
    ->name('tickets.mark');

Route::get('/widget', [WidgetController::class, 'index']);

Route::get('/download/{id}', [MediaDownloadController::class, 'index'])
    ->middleware('can:see tickets')
    ->name('download');

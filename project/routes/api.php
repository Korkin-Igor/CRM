<?php

use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Route;

Route::post('/tickets', [TicketController::class, 'store']);
Route::get('/tickets/statistics/{period}', [TicketController::class, 'statistics'])
    ->where('period', 'day|week|month');

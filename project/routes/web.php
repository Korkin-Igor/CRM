<?php

use App\Http\Controllers\Api\TicketController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes(); // не стал замарачиваться с аутентификацией/регистрацией, так что использую дефолтные роуты

Route::get('/widget', function () {
    return view('widget');
})->name('widget');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/{ticket}', [TicketController::class, 'show'])->name('tickets.show');
    Route::get('/tickets/{ticket}/edit', [TicketController::class, 'edit'])->name('tickets.edit');
    Route::put('/tickets/{ticket}', [TicketController::class, 'update'])->name('tickets.update');
});

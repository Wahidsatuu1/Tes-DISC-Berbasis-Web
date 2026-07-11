<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PsikotesController;

Route::get('/', function () {
    return view('welcome');
})->name('landing');
Route::get('/psikotes', [PsikotesController::class, 'index'])->name('psikotes.index');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/psikotes/submit', [PsikotesController::class, 'submit']);
Route::get('/psikotes/pdf/{id}', [PsikotesController::class, 'exportPdf'])->name('psikotes.pdf');
Route::delete('/psikotes/{id}', [PsikotesController::class, 'destroy'])->name('psikotes.destroy');

Route::get('/lang/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'id'])) {
        session(['locale' => $locale]);
    }
    return redirect()->back();
});

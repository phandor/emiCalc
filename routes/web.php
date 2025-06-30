<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmiCalcController;

Route::get('/', function () {
    return view('home');
});

Route::post('/emissions/calculate', [EmiCalcController::class, 'calculate'])
    ->name('emissions.calculate');
Route::get('/emissions', [EmiCalcController::class, 'showForm'])->name('emissions.form');
Route::post('/emissions/calculate', [EmiCalcController::class, 'calculate'])->name('emissions.calculate');
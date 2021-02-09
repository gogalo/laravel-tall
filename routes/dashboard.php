<?php

use App\Http\Livewire\Companies;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubscriberController;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('subscribers', [SubscriberController::class, 'all'])
    ->name('subscribers.all')
;

Route::get('companies', Companies::class)
    ->name('companies')
;

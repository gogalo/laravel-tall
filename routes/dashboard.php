<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
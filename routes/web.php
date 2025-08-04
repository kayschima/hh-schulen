<?php

use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StaticController;
use Illuminate\Support\Facades\Route;

Route::get('/', SchoolController::class)->name('school.index');

Route::get('/impressum', [StaticController::class, 'impressum'])->name('impressum');
Route::get('/datenschutz', [StaticController::class, 'datenschutz'])->name('datenschutz');

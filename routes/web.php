<?php

use App\Http\Controllers\SchoolController;
use Illuminate\Support\Facades\Route;

Route::get('/', SchoolController::class)->name('school.index');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';

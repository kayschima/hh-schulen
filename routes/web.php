<?php

use App\Models\School;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home',
        ['schools' => School::query()->orderBy('schulname')->paginate(10)]
    );
});

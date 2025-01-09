<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class StaticController extends Controller
{
    public function impressum()
    {
        return Inertia::render('Impressum');
    }

    public function datenschutz()
    {
        return Inertia::render('Datenschutz');
    }
}

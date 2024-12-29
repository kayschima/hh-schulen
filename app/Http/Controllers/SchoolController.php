<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SchoolController extends Controller
{
    public function __invoke(Request $request)
    {
        return Inertia::render('Home',
            [
                'schools' => School::query()
                    ->when($request->search, fn ($query, $search) => $query->where('schulname', 'LIKE', '%'.$search.'%')
                        ->orWhere('adresse_strasse_hausnr', 'LIKE', '%'.$search.'%'))
                    ->orderBy('schulname')
                    ->paginate(10)
                    ->withQueryString(),
                'search' => $request->search,
            ]
        );
    }
}

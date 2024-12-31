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
                    ->when($request->search, fn ($query, $search) => $query->where('schul_id', 'LIKE', '%'.$search.'%')
                        ->orWhere('schulname', 'LIKE', '%'.$search.'%')
                        ->orWhere('adresse_strasse_hausnr', 'LIKE', '%'.$search.'%')
                        ->orWhere('rechtsform', 'LIKE', '%'.$search.'%')
                        ->orWhere('schulform', 'LIKE', '%'.$search.'%')
                        ->orWhere('ganztagsform', 'LIKE', '%'.$search.'%')
                        ->orWhere('kapitelbezeichnung', 'LIKE', '%'.$search.'%')
                    )
                    ->orderBy('schulname')
                    ->orderBy('schul_id')
                    ->paginate(10)
                    ->withQueryString(),
                'search' => $request->search,
            ]
        );
    }
}

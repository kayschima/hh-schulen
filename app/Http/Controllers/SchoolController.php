<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SchoolController extends Controller
{
    public function __invoke(Request $request)
    {
        $words = explode(' ', $request->search);

        $query = School::query();

        foreach ($words as $word) {
            $query->where(function ($query) use ($word) {
                $query->where('schul_id', 'LIKE', '%'.$word.'%')
                    ->orWhere('schulname', 'LIKE', '%'.$word.'%')
                    ->orWhere('adresse_strasse_hausnr', 'LIKE',
                        '%'.$word.'%')
                    ->orWhere('rechtsform', 'LIKE', '%'.$word.'%')
                    ->orWhere('schulform', 'LIKE', '%'.$word.'%')
                    ->orWhere('ganztagsform', 'LIKE', '%'.$word.'%')
                    ->orWhere('kapitelbezeichnung', 'LIKE', '%'.$word.'%')
                    ->orWhere('abschluss', 'LIKE', '%'.$word.'%')
                    ->orWhere('bezirk', 'LIKE', '%'.$word.'%');
            });
        }

        return Inertia::render('Home',
            [
                'schools' => $query
                    ->orderBy('schulname')
                    ->orderBy('schul_id')
                    ->paginate(10)
                    ->withQueryString(),
                'search' => $request->search,
            ]
        );
    }
}

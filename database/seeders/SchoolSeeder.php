<?php

namespace Database\Seeders;

use App\Models\School;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class SchoolSeeder extends Seeder
{
    public function run(): void
    {
        $response = Http::get('https://api.hamburg.de/datasets/v1/schulen/collections/staatliche_schulen/items?f=json&limit=600')->fluent();
        foreach ($response['features'] as $school) {
            $this->extracted($school);
        }

        $response = Http::get('https://api.hamburg.de/datasets/v1/schulen/collections/nicht_staatliche_schulen/items?f=json&limit=600')->fluent();
        foreach ($response['features'] as $school) {
            $this->extracted($school);
        }
    }

    public function extracted(mixed $school): void
    {
        School::create([
            'id' => $school['id'],
            'schul_id' => $school['properties']['schul_id'],
            'schulname' => $school['properties']['schulname'],
            'adresse_strasse_hausnr' => $school['properties']['adresse_strasse_hausnr'],
            'adresse_ort' => $school['properties']['adresse_ort'],
            'schul_telefonnr' => $school['properties']['schul_telefonnr'] ?? null,
            'fax' => $school['properties']['fax'] ?? null,
            'bezirk' => $school['properties']['bezirk'],
            'kapitelbezeichnung' => $school['properties']['kapitelbezeichnung'] ?? null,
            'abschluss' => $school['properties']['abschluss'] ?? null,
            'rechtsform' => $school['properties']['rechtsform'] ?? null,
            'schulform' => $school['properties']['schulform'] ?? null,
            'ganztagsform' => $school['properties']['ganztagsform'] ?? null,
        ]);
    }
}

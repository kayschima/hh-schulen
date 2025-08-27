<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected function casts(): array
    {
        return [
            'anzahl_schueler' => 'string',
        ];
    }
}

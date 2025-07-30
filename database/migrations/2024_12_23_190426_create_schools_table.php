<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('schul_id');
            $table->string('schulname');
            $table->string('adresse_strasse_hausnr');
            $table->string('adresse_ort');
            $table->string('schul_telefonnr')->nullable();
            $table->string('fax')->nullable();
            $table->string('bezirk');
            $table->string('kapitelbezeichnung')->nullable();
            $table->string('abschluss')->nullable();
            $table->string('rechtsform')->nullable();
            $table->string('schulform')->nullable();
            $table->string('ganztagsform')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schools');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehicle_societe', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('marque');
            $table->string('model');
            $table->string('immatriculation');
            $table->date('datemec');
            $table->string('usage');
            $table->string('site');
            $table->string('copiecg');
            $table->string('copieassurance');
            $table->string('affectation');
            $table->string('commentaire');
            $table->date('datect');
            $table->date('dateprochainct');
            $table->date('dateentretien');
            $table->date('dateprochainentretien');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicle_societe');
    }
};

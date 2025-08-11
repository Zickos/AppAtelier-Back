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
            $table->string('marque')->nullable();
            $table->string('model')->nullable();
            $table->string('immatriculation');
            $table->date('datemec')->nullable();
            $table->string('usage')->nullable();
            $table->string('site')->nullable();
            $table->string('copiecg')->nullable();
            $table->string('copieassurance')->nullable();
            $table->string('affectation')->nullable();
            $table->string('commentaire')->nullable();
            $table->date('datect')->nullable();
            $table->date('dateprochainct')->nullable();
            $table->date('dateentretien')->nullable();
            $table->date('dateprochainentretien')->nullable();
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

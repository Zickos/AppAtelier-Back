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
        Schema::create('plannings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->date('date_debut');
            $table->date('date_fin');

            $table->text('commentaire')->nullable();
            $table->boolean('etat')->default(false);

            // Liens vers les autres entités
            $table->foreignId('vehicle_id')
                ->nullable()
                ->constrained('vehicles')
                ->name('fk_plannings_vehicle_id')
                ->index();

            $table->foreignId('retrofit_id')
                ->nullable()
                ->constrained('retrofits')
                ->name('fk_plannings_retrofit_id')
                ->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plannings');
    }
};

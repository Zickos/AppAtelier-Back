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
        Schema::create('retrofits', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->nullable(); // Numéro de série du retrofit
            $table->boolean('etat')->default(false); 
            $table->text('commentaire')->nullable();
            $table->date('date')->nullable(); 
            $table->timestamps(); // created_at et updated_at

            $table->foreignId('vehicle_id')->constrained('vehicles')->name('fk_retrofits_vehicle_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retrofits');
    }
};

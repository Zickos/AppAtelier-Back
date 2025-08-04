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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('marque');
            $table->string('id_client');
            $table->string('owner');
            $table->string('num_serie')->unique();
            $table->timestamps();

            $table->foreignId('type_vehicle_id')->constrained('type_vehicles')->name('fk_vehicles_type_vehicle_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};

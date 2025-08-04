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
        Schema::create('retrofits_types_travaux', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->foreignId('retrofit_id')->constrained('retrofits')->name('fk_retrofits_retrofit_id')->index();
            $table->foreignId('type_travail_id')->constrained('types_travails')->name('fk_retrofits_type_travail_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('retrofits_types_travaux');
    }
};

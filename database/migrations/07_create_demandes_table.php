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
        Schema::create('demandes', function (Blueprint $table) {
            $table->id();
            $table->text('commentaire')->nullable();
            $table->date('date')->nullable(); 
            $table->boolean('etat')->default(false); 
            $table->enum('type', ['Commande', 'Retrait']);
            $table->timestamps();

            $table->foreignId('user_id')->constrained('users')->name('fk_demandes_user_id')->index();
            $table->foreignId('retrofit_id')->constrained()->name('fk_demandes_retrofit_id')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('demandes');
    }
};

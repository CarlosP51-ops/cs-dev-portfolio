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
        Schema::create('projets', function (Blueprint $table) {
            $table->id(); 
            $table->string('title'); 
            $table->text('description'); 
            $table->text('objectives'); 
            $table->text('challenges'); 
            $table->text('fonctionnalites');
            $table->string('imagefirst'); 
            $table->string('link_visualisation')->nullable(); 
            $table->string('link_github')->nullable(); 
            $table->enum('status', ['termine', 'en_attente']);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projets'); // Suppression de la table si la migration est annulée
    }
};
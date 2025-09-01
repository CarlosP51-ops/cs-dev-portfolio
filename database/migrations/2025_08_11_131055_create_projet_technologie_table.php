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
        Schema::create('projet_technologie', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('projet_id');      // Clé étrangère vers la table projets
            $table->unsignedBigInteger('technologie_id');  // Clé étrangère vers la table technologies
            $table->timestamps();

            $table->foreign('projet_id')->references('id')->on('projets')->onDelete('cascade');
            $table->foreign('technologie_id')->references('id')->on('technologies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projet_technologie');
    }
};

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
        Schema::create('users', function (Blueprint $table) {
    $table->id();
    $table->string('name');
    $table->string('surname');
    $table->string('email')->unique();
    $table->string('tel')->unique();
    $table->string('photo_de_profil')->nullable();
    $table->string('password');
    $table->string('cv_path')->nullable();
    
    // Ajout des nouveaux champs
    $table->string('facebook_link')->nullable();
    $table->string('github_link')->nullable();
    $table->string('linkedin_link')->nullable();
    $table->string('service')->nullable();

    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

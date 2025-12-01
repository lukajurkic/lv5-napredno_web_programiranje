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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();

            // nastavnik koji je unio rad
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');

            // podaci o radu
            $table->string('title_hr');       // naziv rada
            $table->string('title_en');       // naziv rada na engleskom
            $table->text('description');      // zadatak rada

            // tip studija
            $table->enum('study_type', [
                'strucni',
                'preddiplomski',
                'diplomski'
            ]);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};

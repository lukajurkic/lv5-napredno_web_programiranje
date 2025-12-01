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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            $table->foreignId('student_id')->constrained('users')->onDelete('cascade'); // student koji se prijavio
            $table->enum('status', ['pending', 'accepted'])->default('pending'); // status prijave
            $table->timestamps();

            $table->unique(['task_id', 'student_id']); // student se ne može prijaviti više puta na isti rad
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};

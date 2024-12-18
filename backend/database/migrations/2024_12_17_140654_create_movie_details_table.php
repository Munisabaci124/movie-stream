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
        Schema::create('movie_details', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('movie_id')->constrained()->onDelete('cascade'); // Foreign key ke movies
            $table->text('description')->nullable(); // Deskripsi film
            $table->integer('duration')->nullable(); // Durasi dalam menit
            $table->decimal('rating', 3, 1)->nullable(); // Rating film, contoh: 4.5
            $table->timestamps(); // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_details');
    }
};

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
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title');
            $table->integer('year');
            $table->integer('runtime');
            $table->text('description');
            $table->string('image_url');
            $table->string('director');
            $table->string('age_restriction');
            $table->text('cast');
        });

        Schema::create('genres', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('name');
        });

        Schema::create('movie_genre', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
            $table->foreignId('genre_id')->constrained()->onDelete('cascade');
        });

        Schema::create('screens', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('number');
            $table->string('technology');
        });

        Schema::create('seats', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('screen_id')->constrained()->onDelete('cascade');
            $table->string('row');
            $table->integer('number');
            $table->boolean('wheelchair_reserved');
        });

        Schema::create('screenings', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->time('projection_time');
            $table->date('projection_date');
            $table->foreignId('screen_id')->constrained()->onDelete('cascade');
            $table->foreignId('movie_id')->constrained()->onDelete('cascade');
        });

        Schema::create('reservations', function (Blueprint $table){
            $table->foreignId('seat_id')->constrained()->onDelete('cascade');
            $table->foreignId('screening_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });

        Schema::create('tickets', function (Blueprint $table){
            $table->foreignId('seat_id')->constrained()->onDelete('cascade');
            $table->foreignId('screening_id')->constrained()->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
        Schema::dropIfExists('genres');
        Schema::dropIfExists('movie_genre');
        Schema::dropIfExists('screens');
        Schema::dropIfExists('seats');
        Schema::dropIfExists('screenings'); 
    }
};

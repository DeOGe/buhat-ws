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
        Schema::create('sets', function (Blueprint $table) {
            $table->id('set_id');
            $table->unsignedBigInteger('workout_exercise_id');
            $table->unsignedInteger('set_number');
            $table->unsignedInteger('reps')->nullable();
            $table->string('weight')->nullable(); // use string if not computing
            $table->string('time')->nullable();   // for time-based exercises
            $table->string('distance')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->foreign('workout_exercise_id')->references('workout_exercise_id')->on('workout_exercises')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sets');
    }
};

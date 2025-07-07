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
        Schema::create('exercises', function (Blueprint $table) {
            $table->id('exercise_id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->unsignedBigInteger('equipment_id')->nullable();
            $table->unsignedBigInteger('muscle_id')->nullable();
            $table->string('video_url')->nullable();
            $table->timestamps();

            // Foreign Key Constraints
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('set null');
            $table->foreign('equipment_id')->references('equipment_id')->on('equipments')->onDelete('set null');
            $table->foreign('muscle_id')->references('muscle_id')->on('muscles')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};

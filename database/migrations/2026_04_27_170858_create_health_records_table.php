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
        Schema::create('health_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('record_date');
            $table->integer('steps')->default(0);
            $table->decimal('calories_burned', 8, 2)->default(0);
            $table->decimal('water_intake', 5, 2)->default(0); // in liters
            $table->integer('sleep_hours')->default(0);
            $table->decimal('weight', 5, 2)->nullable();
            $table->decimal('heart_rate', 5, 2)->nullable();
            $table->integer('blood_pressure_systolic')->nullable();
            $table->integer('blood_pressure_diastolic')->nullable();
            $table->enum('mood', ['happy', 'neutral', 'sad', 'stressed', 'energetic'])->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->unique(['user_id', 'record_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('health_records');
    }
};

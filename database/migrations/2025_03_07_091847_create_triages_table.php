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
        Schema::create('triages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained('registrations')->cascadeOnDelete();
            $table->string('temperature')->nullable();
            $table->string('pressure')->nullable();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('triages');
    }
};

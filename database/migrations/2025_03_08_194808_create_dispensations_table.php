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
        Schema::create('dispensations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('drug_id')->constrained('drugs')->onDelete('cascade');
            $table->foreignId('patient_id')->constrained('registrations')->onDelete('cascade');
            $table->integer('quantity_dispensed_mL')->nullable(); // For tablets & liquid drugs
            $table->integer('bottles_dispensed')->nullable(); // Number of bottles dispensed
            $table->foreignId('dispensed_by')->constrained('users')->onDelete('cascade'); // Pharmacist/Doctor
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dispensations');
    }
};

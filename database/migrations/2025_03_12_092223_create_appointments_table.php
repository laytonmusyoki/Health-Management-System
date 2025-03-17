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
        Schema::create('appointments', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('doctor_id');
            $table->string('doctorName');
            $table->string('patientName');
            $table->string('email');
            $table->string('phone');
            $table->string('date');
            $table->string('time');
            $table->string('reason');
            $table->string('status')->default('Pending');
            
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('appointments');
    }
};

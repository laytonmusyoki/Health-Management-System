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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->string('idNo')->nullable();
            $table->string('surName')->nullable();
            $table->string('firstName')->nullable();
            $table->string('secondName')->nullable();
            $table->string('gender')->nullable();
            $table->string('dateOfBirth')->nullable();
            $table->string('age')->nullable();
            $table->string('phoneNumber')->nullable();
            $table->string('nextOfKin')->nullable();
            $table->string('country')->nullable();
            $table->string('county')->nullable();
            $table->string('subCounty')->nullable();
            $table->string('location')->nullable();
            $table->string('occupation')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('education')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};

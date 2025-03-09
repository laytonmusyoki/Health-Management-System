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
        Schema::create('drugs', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->enum('drug_type', ['tablet', 'liquid', 'bottle']);
            $table->string('unit_measurement')->nullable(); 
            $table->integer('bottle_size_mL')->nullable(); // Size per bottle (for liquid drugs)
            $table->integer('bottles_in_stock')->default(0); // Total bottles in stock
            $table->integer('total_quantity_mL')->default(0); // Total available quantity (tablets or liquid mL)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drugs');
    }
};

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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->string('supplier')->nullable();
            $table->string('batch_number')->nullable();
            $table->foreignId('drug_id')->constrained('drugs')->onDelete('cascade');
            $table->integer('quantity_mL')->nullable(); 
            $table->integer('tablets_added')->nullable(); 
            $table->integer('bottles_added')->nullable(); 
            $table->date('expiry_date')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};

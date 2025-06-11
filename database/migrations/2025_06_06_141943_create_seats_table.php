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
        Schema::create('seats', function (Blueprint $table) {
        $table->id();
        $table->string('seat_number');
        $table->decimal('price', 8, 2);
        $table->string('from');          // New
        $table->string('to');            // New
        $table->date('travel_date');     // New
        $table->date('travel_time');
        $table->string('date')->nullable(); // Optional date field
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seats');
    }
};

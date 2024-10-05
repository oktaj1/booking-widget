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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hotel_id')->constrained()->onDelete('cascade'); // Hotel relation
            $table->string('room_type');
            $table->decimal('price_per_night', 8, 2);
            $table->integer('capacity');
            $table->timestamps();
        });
        
    }
};

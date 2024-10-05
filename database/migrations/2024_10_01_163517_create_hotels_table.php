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
        Schema::create('hotels', function (Blueprint $table) {
            $table->id(); // or use ULID if you're following your previous approach
            $table->string('name');
            $table->string('location');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
    }

};
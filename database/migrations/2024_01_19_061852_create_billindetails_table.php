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
        Schema::create('billindetails', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');         
            $table->string('venue_rental')->nullable();
            $table->string('hotel_rooms')->nullable();
            $table->string('equipment')->nullable();
            $table->string('setup')->nullable();
            $table->string('bar')->nullable();
            $table->string('special_req')->nullable();
            $table->string('food')->nullable();
            $table->integer('status')->default(0);
            $table->integer('created_by')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billindetails');
    }
};

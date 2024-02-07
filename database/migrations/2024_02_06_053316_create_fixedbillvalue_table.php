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
        Schema::create('fixedbillvalue', function (Blueprint $table) {
            $table->id();
            $table->string('venue')->unique();
            $table->string('venue_cost')->default(0);
            $table->integer('hotel_rooms')->default(0);
            $table->integer('equipment')->default(0);
            $table->integer('welcomesetup')->default(0);
            $table->integer('rehearsalsetup')->default(0);
            $table->integer('specialsetup')->default(0);
            $table->integer('special_req')->default(0);
            $table->integer('brunch')->default(0);
            $table->integer('lunch')->default(0);
            $table->integer('dinner')->default(0);
            $table->integer('wedding')->default(0);
            $table->integer('bar_package')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fixedbillvalue');
    }
};

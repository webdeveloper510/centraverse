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
        Schema::create('billing', function (Blueprint $table) {
            $table->id();
            $table->integer('venue_rental')->default(0);
            $table->integer('hotel_rooms')->default(0);
            $table->integer('equipment')->default(0);
            $table->integer('setup')->default(0);
            $table->integer('special_req')->default(0);
            $table->integer('total')->default(0);
            $table->integer('occupancy_tax')->default(0);
            $table->integer('service_charges')->default(0);
            $table->integer('grand_total')->default(0);
            $table->integer('deposits')->default(0);
            $table->integer('balance_due')->default(0);
            $table->integer('premium_breakfast')->default(0);
            $table->integer('classic_brunch')->default(0);
            $table->integer('hot_luncheon')->default(0);
            $table->integer('cold_luncheon')->default(0);
            $table->integer('barbecue')->default(0);
            $table->integer('adirondack_dinner')->default(0);
            $table->integer('emeraldk_dinner')->default(0);
            $table->integer('elite_dinner')->default(0);
            $table->integer('premium_wedding')->default(0);
            $table->integer('elite_wedding')->default(0);
            $table->integer('plated_wedding')->default(0);
            $table->integer('platinum_4hrs')->default(0);
            $table->integer('platinum_3hrs')->default(0);
            $table->integer('platinum_2hrs')->default(0);
            $table->integer('gold_4hrs')->default(0);
            $table->integer('gold_3hrs')->default(0);
            $table->integer('gold_2hrs')->default(0);
            $table->integer('silver_4hrs')->default(0);
            $table->integer('silver_3hrs')->default(0);
            $table->integer('silver_2hrs')->default(0);
            $table->integer('beer_4hrs')->default(0);
            $table->integer('beer_3hrs')->default(0);
            $table->integer('beer_2hrs')->default(0);
            $table->integer('hot_appetiz')->default(0);
            $table->integer('cold_appetiz')->default(0);
            $table->integer('additional_options')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('billing');
    }
};

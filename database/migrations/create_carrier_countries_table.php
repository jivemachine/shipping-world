<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('carrier_countries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('world_country_id')->index();

            $table->string('iso_alpha2', 2)->index();
            $table->string('iso_alpha3', 3)->nullable();
            $table->string('name');

            $table->boolean('is_shipping_supported')->default(true);

            // Carrier support flags
            $table->boolean('supports_ups')->default(true);
            $table->boolean('supports_usps')->default(true);
            $table->boolean('supports_fedex')->default(true);

            // Optional carrier-specific codes (can refine later)
            $table->string('ups_code', 10)->nullable();
            $table->string('usps_code', 10)->nullable();
            $table->string('fedex_code', 10)->nullable();

            // Form metadata
            $table->boolean('requires_postcode')->default(true);
            $table->boolean('requires_region')->default(true);
            $table->string('region_label')->default('State / Province');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrier_countries');
    }
};

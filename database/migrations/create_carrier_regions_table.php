<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('carrier_regions', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('carrier_country_id')->index();
            $table->unsignedBigInteger('world_state_id')->nullable()->index();

            $table->string('iso_subdivision_code')->nullable(); // e.g. US-CA
            $table->string('code', 10)->nullable(); // e.g. CA
            $table->string('name');

            $table->boolean('is_active')->default(true);

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('carrier_regions');
    }
};

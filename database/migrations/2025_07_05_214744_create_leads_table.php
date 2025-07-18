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
        Schema::create('leads', function (Blueprint $table) {
            $table->id();

            $table->string('lead_name');
            $table->string('lead_email')->unique();
            $table->string('lead_phone')->unique();
            $table->string('lead_country')->nullable();
            $table->string('lead_street')->nullable();
            $table->string('lead_suburb')->nullable();
            $table->string('lead_state')->nullable();
            $table->string('lead_postcode')->nullable();
            $table->string('lead_storage_type')->nullable();
            $table->string('lead_vehicle_type')->nullable();
            $table->string('lead_rego_number')->nullable();
            $table->integer('lead_status')->nullable();
            $table->float('lead_score')->nullable();

            $table->text('lead_photo')->nullable();
            $table->text('lead_asset_photo')->nullable();
            $table->text('lead_driver_license')->nullable();

            $table->string('lead_emergency_contact_name')->nullable();
            $table->string('lead_emergency_contact_phone')->nullable();
            $table->string('lead_emergency_contact_address')->nullable();
            $table->longText('lead_remarks')->nullable();

            $table->dateTime('lead_last_contact_datetime')->nullable();
            $table->string('lead_contact_method')->nullable();
            $table->dateTime('lead_followup_reminder')->nullable();
            $table->longText('lead_contact_remarks')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};

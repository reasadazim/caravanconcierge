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

            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('suburb')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();

            $table->string('vehicle_type')->nullable();
            $table->float('vehicle_length')->nullable();
            $table->string('rego_number')->nullable();

            $table->text('photo')->nullable();
            $table->text('asset_photo')->nullable();
            $table->text('driver_license')->nullable();

            $table->integer('status')->nullable();
            $table->integer('score')->nullable();

            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_address')->nullable();

            $table->longText('remarks')->nullable();

            $table->dateTime('last_contact_datetime')->nullable();
            $table->string('contact_method')->nullable();
            $table->dateTime('followup_reminder')->nullable();
            $table->longText('contact_remarks')->nullable();

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

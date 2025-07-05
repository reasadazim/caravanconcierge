<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lead_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('lead_id')->nullable();

            // All fields from leads table
            $table->string('lead_name')->nullable();
            $table->string('lead_email')->nullable();
            $table->string('lead_phone')->nullable();
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
            $table->text('lead_remarks')->nullable();
            $table->dateTime('lead_last_contact_datetime')->nullable();
            $table->string('lead_contact_method')->nullable();
            $table->dateTime('lead_followup_reminder')->nullable();
            $table->text('lead_contact_remarks')->nullable();

            // Extra logging info
            $table->enum('action_type', ['INSERT', 'UPDATE', 'DELETE']);
            $table->timestamp('logged_at')->useCurrent();
        });


        // INSERT trigger
        DB::unprepared('
        CREATE TRIGGER after_leads_insert
        AFTER INSERT ON leads
        FOR EACH ROW
        INSERT INTO lead_logs (
            lead_id, lead_name, lead_email, lead_phone, lead_country, lead_street,
            lead_suburb, lead_state, lead_postcode, lead_storage_type, lead_vehicle_type,
            lead_rego_number, lead_status, lead_score, lead_photo, lead_asset_photo,
            lead_driver_license, lead_emergency_contact_name, lead_emergency_contact_phone,
            lead_emergency_contact_address, lead_remarks, lead_last_contact_datetime,
            lead_contact_method, lead_followup_reminder, lead_contact_remarks,
            action_type, logged_at
        )
        VALUES (
            NEW.id, NEW.lead_name, NEW.lead_email, NEW.lead_phone, NEW.lead_country, NEW.lead_street,
            NEW.lead_suburb, NEW.lead_state, NEW.lead_postcode, NEW.lead_storage_type, NEW.lead_vehicle_type,
            NEW.lead_rego_number, NEW.lead_status, NEW.lead_score, NEW.lead_photo, NEW.lead_asset_photo,
            NEW.lead_driver_license, NEW.lead_emergency_contact_name, NEW.lead_emergency_contact_phone,
            NEW.lead_emergency_contact_address, NEW.lead_remarks, NEW.lead_last_contact_datetime,
            NEW.lead_contact_method, NEW.lead_followup_reminder, NEW.lead_contact_remarks,
            "INSERT", NOW()
        )
    ');

        // UPDATE trigger
        DB::unprepared('
        CREATE TRIGGER after_leads_update
        AFTER UPDATE ON leads
        FOR EACH ROW
        INSERT INTO lead_logs (
            lead_id, lead_name, lead_email, lead_phone, lead_country, lead_street,
            lead_suburb, lead_state, lead_postcode, lead_storage_type, lead_vehicle_type,
            lead_rego_number, lead_status, lead_score, lead_photo, lead_asset_photo,
            lead_driver_license, lead_emergency_contact_name, lead_emergency_contact_phone,
            lead_emergency_contact_address, lead_remarks, lead_last_contact_datetime,
            lead_contact_method, lead_followup_reminder, lead_contact_remarks,
            action_type, logged_at
        )
        VALUES (
            NEW.id, NEW.lead_name, NEW.lead_email, NEW.lead_phone, NEW.lead_country, NEW.lead_street,
            NEW.lead_suburb, NEW.lead_state, NEW.lead_postcode, NEW.lead_storage_type, NEW.lead_vehicle_type,
            NEW.lead_rego_number, NEW.lead_status, NEW.lead_score, NEW.lead_photo, NEW.lead_asset_photo,
            NEW.lead_driver_license, NEW.lead_emergency_contact_name, NEW.lead_emergency_contact_phone,
            NEW.lead_emergency_contact_address, NEW.lead_remarks, NEW.lead_last_contact_datetime,
            NEW.lead_contact_method, NEW.lead_followup_reminder, NEW.lead_contact_remarks,
            "UPDATE", NOW()
        )
    ');

        // DELETE trigger
        DB::unprepared('
        CREATE TRIGGER after_leads_delete
        AFTER DELETE ON leads
        FOR EACH ROW
        INSERT INTO lead_logs (
            lead_id, lead_name, lead_email, lead_phone, lead_country, lead_street,
            lead_suburb, lead_state, lead_postcode, lead_storage_type, lead_vehicle_type,
            lead_rego_number, lead_status, lead_score, lead_photo, lead_asset_photo,
            lead_driver_license, lead_emergency_contact_name, lead_emergency_contact_phone,
            lead_emergency_contact_address, lead_remarks, lead_last_contact_datetime,
            lead_contact_method, lead_followup_reminder, lead_contact_remarks,
            action_type, logged_at
        )
        VALUES (
            OLD.id, OLD.lead_name, OLD.lead_email, OLD.lead_phone, OLD.lead_country, OLD.lead_street,
            OLD.lead_suburb, OLD.lead_state, OLD.lead_postcode, OLD.lead_storage_type, OLD.lead_vehicle_type,
            OLD.lead_rego_number, OLD.lead_status, OLD.lead_score, OLD.lead_photo, OLD.lead_asset_photo,
            OLD.lead_driver_license, OLD.lead_emergency_contact_name, OLD.lead_emergency_contact_phone,
            OLD.lead_emergency_contact_address, OLD.lead_remarks, OLD.lead_last_contact_datetime,
            OLD.lead_contact_method, OLD.lead_followup_reminder, OLD.lead_contact_remarks,
            "DELETE", NOW()
        )
    ');


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS after_leads_insert');
        DB::unprepared('DROP TRIGGER IF EXISTS after_leads_update');
        DB::unprepared('DROP TRIGGER IF EXISTS after_leads_delete');

        Schema::dropIfExists('lead_logs');
    }

};

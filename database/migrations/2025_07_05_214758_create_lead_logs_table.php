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

            // All updated fields from leads table
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('street')->nullable();
            $table->string('suburb')->nullable();
            $table->string('state')->nullable();
            $table->string('postcode')->nullable();

            $table->integer('type')->nullable();
            $table->string('storage_type')->nullable();
            $table->string('vehicle_type')->nullable();
            $table->string('vehicle_model')->nullable();
            $table->string('vehicle_estimated_value')->nullable();
            $table->string('rego_number')->nullable();
            $table->integer('status')->nullable();
            $table->integer('score')->nullable();
            $table->integer('priority')->nullable();

            $table->text('photo')->nullable();
            $table->text('asset_photo')->nullable();
            $table->text('driver_license')->nullable();

            $table->string('emergency_contact_name')->nullable();
            $table->string('emergency_contact_phone')->nullable();
            $table->string('emergency_contact_address')->nullable();

            $table->longText('remarks')->nullable();
            $table->dateTime('added_to_waitlist')->nullable();
            $table->dateTime('last_contact_datetime')->nullable();
            $table->string('contact_method')->nullable();
            $table->dateTime('followup_reminder')->nullable();
            $table->longText('contact_remarks')->nullable();

            $table->enum('action_type', ['INSERT', 'UPDATE', 'DELETE']);
            $table->timestamp('logged_at')->useCurrent();
        });

        // Triggers
        DB::unprepared('
        CREATE TRIGGER after_leads_insert
        AFTER INSERT ON leads
        FOR EACH ROW
        INSERT INTO lead_logs (
            lead_id, name, email, phone, country, street, suburb, state, postcode,
            type, storage_type, vehicle_type, vehicle_model, vehicle_estimated_value,
            rego_number, status, score, priority, photo, asset_photo, driver_license,
            emergency_contact_name, emergency_contact_phone, emergency_contact_address,
            remarks, added_to_waitlist, last_contact_datetime, contact_method,
            followup_reminder, contact_remarks, action_type, logged_at
        )
        VALUES (
            NEW.id, NEW.name, NEW.email, NEW.phone, NEW.country, NEW.street, NEW.suburb, NEW.state, NEW.postcode,
            NEW.type, NEW.storage_type, NEW.vehicle_type, NEW.vehicle_model, NEW.vehicle_estimated_value,
            NEW.rego_number, NEW.status, NEW.score, NEW.priority, NEW.photo, NEW.asset_photo, NEW.driver_license,
            NEW.emergency_contact_name, NEW.emergency_contact_phone, NEW.emergency_contact_address,
            NEW.remarks, NEW.added_to_waitlist, NEW.last_contact_datetime, NEW.contact_method,
            NEW.followup_reminder, NEW.contact_remarks, "INSERT", NOW()
        )
        ');

        DB::unprepared('
        CREATE TRIGGER after_leads_update
        AFTER UPDATE ON leads
        FOR EACH ROW
        INSERT INTO lead_logs (
            lead_id, name, email, phone, country, street, suburb, state, postcode,
            type, storage_type, vehicle_type, vehicle_model, vehicle_estimated_value,
            rego_number, status, score, priority, photo, asset_photo, driver_license,
            emergency_contact_name, emergency_contact_phone, emergency_contact_address,
            remarks, added_to_waitlist, last_contact_datetime, contact_method,
            followup_reminder, contact_remarks, action_type, logged_at
        )
        VALUES (
            NEW.id, NEW.name, NEW.email, NEW.phone, NEW.country, NEW.street, NEW.suburb, NEW.state, NEW.postcode,
            NEW.type, NEW.storage_type, NEW.vehicle_type, NEW.vehicle_model, NEW.vehicle_estimated_value,
            NEW.rego_number, NEW.status, NEW.score, NEW.priority, NEW.photo, NEW.asset_photo, NEW.driver_license,
            NEW.emergency_contact_name, NEW.emergency_contact_phone, NEW.emergency_contact_address,
            NEW.remarks, NEW.added_to_waitlist, NEW.last_contact_datetime, NEW.contact_method,
            NEW.followup_reminder, NEW.contact_remarks, "UPDATE", NOW()
        )
        ');

        DB::unprepared('
        CREATE TRIGGER after_leads_delete
        AFTER DELETE ON leads
        FOR EACH ROW
        INSERT INTO lead_logs (
            lead_id, name, email, phone, country, street, suburb, state, postcode,
            type, storage_type, vehicle_type, vehicle_model, vehicle_estimated_value,
            rego_number, status, score, priority, photo, asset_photo, driver_license,
            emergency_contact_name, emergency_contact_phone, emergency_contact_address,
            remarks, added_to_waitlist, last_contact_datetime, contact_method,
            followup_reminder, contact_remarks, action_type, logged_at
        )
        VALUES (
            OLD.id, OLD.name, OLD.email, OLD.phone, OLD.country, OLD.street, OLD.suburb, OLD.state, OLD.postcode,
            OLD.type, OLD.storage_type, OLD.vehicle_type, OLD.vehicle_model, OLD.vehicle_estimated_value,
            OLD.rego_number, OLD.status, OLD.score, OLD.priority, OLD.photo, OLD.asset_photo, OLD.driver_license,
            OLD.emergency_contact_name, OLD.emergency_contact_phone, OLD.emergency_contact_address,
            OLD.remarks, OLD.added_to_waitlist, OLD.last_contact_datetime, OLD.contact_method,
            OLD.followup_reminder, OLD.contact_remarks, "DELETE", NOW()
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

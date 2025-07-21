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
            $table->float('vehicle_length')->nullable(); // <- Newly added
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
        foreach (['INSERT', 'UPDATE', 'DELETE'] as $action) {
            $when = $action === 'DELETE' ? 'OLD' : 'NEW';
            $columns = implode(', ', [
                'lead_id', 'name', 'email', 'phone', 'country', 'street', 'suburb', 'state', 'postcode',
                'type', 'storage_type', 'vehicle_type', 'vehicle_length', 'vehicle_model', 'vehicle_estimated_value',
                'rego_number', 'status', 'score', 'priority', 'photo', 'asset_photo', 'driver_license',
                'emergency_contact_name', 'emergency_contact_phone', 'emergency_contact_address',
                'remarks', 'added_to_waitlist', 'last_contact_datetime', 'contact_method',
                'followup_reminder', 'contact_remarks', 'action_type', 'logged_at'
            ]);

            $values = implode(', ', [
                "$when.id", "$when.name", "$when.email", "$when.phone", "$when.country", "$when.street",
                "$when.suburb", "$when.state", "$when.postcode", "$when.type", "$when.storage_type",
                "$when.vehicle_type", "$when.vehicle_length", "$when.vehicle_model", "$when.vehicle_estimated_value",
                "$when.rego_number", "$when.status", "$when.score", "$when.priority", "$when.photo",
                "$when.asset_photo", "$when.driver_license", "$when.emergency_contact_name",
                "$when.emergency_contact_phone", "$when.emergency_contact_address", "$when.remarks",
                "$when.added_to_waitlist", "$when.last_contact_datetime", "$when.contact_method",
                "$when.followup_reminder", "$when.contact_remarks", "'$action'", "NOW()"
            ]);

            DB::unprepared("
                CREATE TRIGGER after_leads_" . strtolower($action) . "
                AFTER $action ON leads
                FOR EACH ROW
                INSERT INTO lead_logs ($columns)
                VALUES ($values)
            ");
        }
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

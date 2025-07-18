<?php

namespace Database\Factories;

use App\Models\Leads;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Leads>
 */
class LeadsFactory extends Factory
{
    protected $model = Leads::class;

    public function definition(): array
    {
        return [
            'lead_name' => $this->faker->name,
            'lead_email' => $this->faker->unique()->safeEmail,
            'lead_phone' => $this->faker->unique()->phoneNumber,
            'lead_country' => $this->faker->country,
            'lead_street' => $this->faker->streetAddress,
            'lead_suburb' => $this->faker->city,
            'lead_state' => $this->faker->stateAbbr,
            'lead_postcode' => $this->faker->postcode,
            'lead_storage_type' => $this->faker->randomElement(['Container', 'Shed', 'Garage']),
            'lead_vehicle_type' => $this->faker->randomElement(['Truck', 'Car', 'Van']),
            'lead_rego_number' => strtoupper($this->faker->bothify('???###')),
            'lead_status' => $this->faker->numberBetween(0, 5),
            'lead_score' => $this->faker->randomFloat(1, 0, 5),
            'lead_photo' => null,
            'lead_asset_photo' => null,
            'lead_driver_license' => null,
            'lead_emergency_contact_name' => $this->faker->name,
            'lead_emergency_contact_phone' => $this->faker->phoneNumber,
            'lead_emergency_contact_address' => $this->faker->address,
            'lead_remarks' => $this->faker->sentence,
            'lead_last_contact_datetime' => $this->faker->dateTimeBetween('-30 days', 'now'),
            'lead_contact_method' => $this->faker->randomElement(['Phone', 'Email', 'SMS']),
            'lead_followup_reminder' => $this->faker->dateTimeBetween('now', '+30 days'),
            'lead_contact_remarks' => $this->faker->paragraph,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

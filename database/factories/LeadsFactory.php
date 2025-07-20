<?php

namespace Database\Factories;

use App\Models\Leads;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Leads>
 */
class LeadsFactory extends Factory
{
    protected $model = Leads::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->numerify('04########'), // AU mobile format
            'country' => 'Australia',
            'street' => $this->faker->streetAddress,
            'suburb' => $this->faker->city, // AU suburbs are often cities in faker
            'state' => $this->faker->randomElement(['NSW', 'VIC', 'QLD', 'WA', 'SA', 'TAS', 'ACT', 'NT']),
            'postcode' => $this->faker->numerify('2###'), // AU postcode pattern

            'type' => $this->faker->randomElement([0, 1, 2]), // lead / wait list / in contract
            'storage_type' => $this->faker->randomElement(['Outdoor', 'Covered', 'Indoor']),
            'vehicle_type' => $this->faker->randomElement(['Caravan', 'Boat', 'Jetski', 'Motorhome', 'Trailer']),
            'vehicle_model' => $this->faker->word,
            'vehicle_estimated_value' => (string) $this->faker->numberBetween(5000, 100000),
            'rego_number' => strtoupper($this->faker->bothify('???-####')), // e.g. ABC-1234
            'status' => $this->faker->numberBetween(0, 8),
            'score' => $this->faker->numberBetween(0, 5),
            'priority' => $this->faker->numberBetween(1, 5),

            'photo' => null,
            'asset_photo' => null,
            'driver_license' => null,

            'emergency_contact_name' => $this->faker->name,
            'emergency_contact_phone' => $this->faker->numerify('04########'),
            'emergency_contact_address' => $this->faker->address,

            'remarks' => $this->faker->sentence,
            'added_to_waitlist' => $this->faker->optional()->dateTimeBetween('-60 days', '-1 day'),
            'last_contact_datetime' => $this->faker->optional()->dateTimeBetween('-30 days', 'now'),
            'contact_method' => $this->faker->randomElement(['Phone', 'Email', 'SMS']),
            'followup_reminder' => $this->faker->optional()->dateTimeBetween('now', '+30 days'),
            'contact_remarks' => $this->faker->paragraph,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

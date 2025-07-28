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
            'suburb' => $this->faker->city,
            'state' => $this->faker->randomElement(['NSW', 'VIC', 'QLD', 'WA', 'SA', 'TAS', 'ACT', 'NT']),
            'postcode' => $this->faker->numerify('2###'),

            'vehicle_type' => $this->faker->randomElement(['Caravan', 'Boat', 'Jetski', 'Motorhome', 'Trailer']),
            'vehicle_length' => $this->faker->randomFloat(1, 2.0, 12.0),
            'rego_number' => strtoupper($this->faker->bothify('???-####')),

            'photo' => null,
            'asset_photo' => null,
            'driver_license' => null,

            'status' => $this->faker->numberBetween(1, 8),
            'score' => $this->faker->numberBetween(1, 5),

            'emergency_contact_name' => $this->faker->name,
            'emergency_contact_phone' => $this->faker->numerify('04########'),
            'emergency_contact_address' => $this->faker->address,

            'remarks' => $this->faker->sentence,
            'last_contact_datetime' => $this->faker->optional()->dateTimeBetween('-30 days', 'now'),
            'contact_method' => $this->faker->randomElement(['Phone', 'Email', 'SMS']),
            'followup_reminder' => $this->faker->optional()->dateTimeBetween('now', '+30 days'),
            'contact_remarks' => $this->faker->paragraph,

            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}

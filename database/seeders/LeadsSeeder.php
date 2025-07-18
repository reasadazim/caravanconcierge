<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Leads;

class LeadsSeeder extends Seeder
{
    public function run(): void
    {
        Leads::factory()->count(200)->create();
    }
}

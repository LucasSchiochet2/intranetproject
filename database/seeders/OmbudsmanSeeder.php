<?php

namespace Database\Seeders;

use App\Models\Ombudsman;
use Illuminate\Database\Seeder;

class OmbudsmanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Ombudsman::factory(5)->create();
    }
}

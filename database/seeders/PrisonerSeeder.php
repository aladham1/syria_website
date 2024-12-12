<?php

namespace Database\Seeders;

use App\Models\Prisoner;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrisonerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prisoner::factory()->count(1000)->create();
    }
}

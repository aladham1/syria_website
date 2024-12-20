<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Manager;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(SettingSeeder::class);
        $this->call(PrisonerSeeder::class);
        User::create([
            'name' => 'Admin',
            'is_admin' => true,
            'email' => 'admin@admin.com',
            'password' => bcrypt('password')
        ]);
    }
}

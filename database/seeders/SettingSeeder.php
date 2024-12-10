<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();
        $settings = [
            [
                'key' => 'telgrame',
                'value' => 'https://t.me/syriawebsite'
            ], [
                'key' => 'whatsapp',
                'value' => 'https://whatsapp.com/channel/0029VatoEBm9cDDW2725sA3s'
            ], [
                'key' => 'title1',
                'value' => 'title1'
            ], [
                'key' => 'title2',
                'value' => 'title2'
            ]
        ];
        Setting::insert($settings);
    }
}

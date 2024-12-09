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
                'key' => 'seo_title',
                'value' => 'البحيرة'
            ], [
                'key' => 'price_for_user',
                'value' => 2
            ], [
                'key' => 'whatsapp',
                'value' => '+96560650544'
            ]
        ];
        Setting::insert($settings);
    }
}

<?php

use Illuminate\Database\Seeder;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Setting::create([
            'key' => 'inverter_ip',
            'value' => '127.0.0.1',
        ]);

        \App\Models\Setting::create([
            'key' => 'inverter_port',
            'value' => '8899',
        ]);

        \App\Models\Setting::create([
            'key' => 'inverter_serial',
            'value' => '0000000000',
        ]);

        \App\Models\Setting::create([
            'key' => 'inverter_id',
            'value' => 'XXXX000000000000',
        ]);
    }
}

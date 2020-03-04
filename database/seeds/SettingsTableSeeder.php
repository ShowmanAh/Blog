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
        \App\Setting::create([
            'site_name' => 'laravel Blog',
            'contact_number' => '01024894892',
            'contact_email' => 'showman.sh.ahmed@gmail.com',
            'address' => 'Nasser City',


        ]);
    }
}

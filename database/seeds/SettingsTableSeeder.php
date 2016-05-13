<?php

use App\Settings;
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
        $settings = new Settings();
        $settings->email       = 'jambik@gmail.com';
        $settings->phone       = '+79123456789';
        $settings->description = 'Описание сайта';
        $settings->save();
    }
}

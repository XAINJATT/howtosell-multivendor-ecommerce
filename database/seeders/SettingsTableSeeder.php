<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'STRIPE_PUBLIC_KEY' => 'your_stripe_public_key',
            'STRIPE_SECRET_KEY' => 'your_stripe_secret_key',
        ]);
    }
}

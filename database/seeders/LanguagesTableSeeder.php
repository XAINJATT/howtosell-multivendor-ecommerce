<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::insert([
            'name' => 'English',
            'slug' => 'en',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

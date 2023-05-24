<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;

class CountriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $accreditedCountries = [
            ['status' => 'Active', 'name' => 'Australia', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Belgium', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Canada', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'China', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Denmark', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'France', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Gambia', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Germany', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Ghana', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Greece', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Guinea Conakry', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Guinea Bissau', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Holland', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Kuwait', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Norway', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Sweden', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Turkey', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'United Kingdom and Ireland', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'United States of America', 'type' => 'Accredited'],
            ['status' => 'Active', 'name' => 'Liberia', 'type' => 'Accredited'],
        ];

        $nonAccreditedCountries = [
            ['status' => 'Active', 'name' => 'Mauritania', 'type' => 'Non-Accredited'],
            ['status' => 'Active', 'name' => 'Cyprus', 'type' => 'Non-Accredited'],
            ['status' => 'Active', 'name' => 'Malaysia', 'type' => 'Non-Accredited'],
            ['status' => 'Active', 'name' => 'Mali', 'type' => 'Non-Accredited'],
            ['status' => 'Active', 'name' => 'Portugal', 'type' => 'Non-Accredited'],
            ['status' => 'Active', 'name' => 'Senegal', 'type' => 'Non-Accredited'],
            ['status' => 'Active', 'name' => 'Tunisia', 'type' => 'Non-Accredited'],
            ['status' => 'Active', 'name' => 'UAE - Dubai', 'type' => 'Non-Accredited'],
        ];

        $countries = array_merge($accreditedCountries, $nonAccreditedCountries);

        DB::table('countries')->insert($countries);
    }
}

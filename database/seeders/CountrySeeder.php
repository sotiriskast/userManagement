<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = [
            ['name' => 'Germany', 'code' => 'DEU'],
            ['name' => 'Japan', 'code' => 'JPN'],
            ['name' => 'Canada', 'code' => 'CAN'],
            ['name' => 'United Kingdom', 'code' => 'GBR'],
            ['name' => 'France', 'code' => 'FRA'],
            ['name' => 'Australia', 'code' => 'AUS'],
            ['name' => 'India', 'code' => 'IND'],
            ['name' => 'China', 'code' => 'CHN'],
            ['name' => 'Brazil', 'code' => 'BRA'],
            ['name' => 'South Africa', 'code' => 'ZAF'],
            ['name' => 'Italy', 'code' => 'ITA'],
            ['name' => 'Russia', 'code' => 'RUS'],
        ];

        foreach ($countries as $country) {
            Country::create($country);
        }
    }
}

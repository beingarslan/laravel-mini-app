<?php

namespace Database\Seeders;

use App\Models\Constituency;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConstituencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $constituencies = [
            [
                'constituency_name' => 'Shangri-la-Town'
            ],
            [
                'constituency_name' => 'Northern-Kunlun-Mountain'
            ],
            [
                'constituency_name' => 'Western-Shangri-la'
            ],
            [
                'constituency_name' => 'Naboo-Vallery'
            ],
            [
                'constituency_name' => 'New-Felucia'
            ],
        ];

        Constituency::insert($constituencies);
    }
}

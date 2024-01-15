<?php

namespace Database\Seeders;

use App\Models\Party;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PartySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $parties = [];

        for ($i=0; $i < rand(5,10); $i++) {
            $parties[] =             [
                'party_name' => $faker->company,
            ];
        }

        Party::insert($parties);
    }
}

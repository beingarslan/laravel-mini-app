<?php

namespace Database\Seeders;

use App\Models\Candidate;
use App\Models\Constituency;
use App\Models\Party;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $party_ids = Party::pluck('id')->toArray();
        $constituency_ids = Constituency::pluck('id')->toArray();

        $candidates = [];

        for ($i=0; $i < 5; $i++) {
            $candidates[] = [
                'party_id' => $faker->randomElement($party_ids),
                'constituency_id' => $faker->randomElement($constituency_ids),
                'candidate' => $faker->name,
                'vote_count' => rand(0, 1000),
            ];
        }

        Candidate::insert($candidates);
    }
}

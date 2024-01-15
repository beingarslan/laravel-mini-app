<?php

namespace Database\Seeders;

use App\Models\Constituency;
use App\Models\UvcCode;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $uv_code_ids = UvcCode::pluck('id')->toArray();
        $constituency_ids = Constituency::pluck('id')->toArray();


        $users = [];

        for ($i=0; $i < 10; $i++) {
            $users = 
        }
    }
}

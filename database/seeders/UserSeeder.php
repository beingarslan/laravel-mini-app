<?php

namespace Database\Seeders;

use App\Models\Constituency;
use App\Models\User;
use App\Models\UvcCode;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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


        $users = [
            [
                'name' => $faker->name(),
                'uv_code_id' => $faker->randomElement($uv_code_ids),
                'email' => 'user@user.com',
                'password' => Hash::make('1234567890'),
                'is_election_commission_officer' => false,
            ],
            [
                'name'=> 'Election Commission Officer',
                'uv_code_id' => $faker->randomElement($uv_code_ids),
                'email' => 'election@shangrila.gov.sr',
                'password' => Hash::make('shangrila2024$'),
                'is_election_commission_officer' => true,
            ],
            [
                'name'=> 'Election Commission Officer',
                'uv_code_id' => $faker->randomElement($uv_code_ids),
                'email' => 'admin@admin.com',
                'password' => Hash::make('1234567890'),
                'is_election_commission_officer' => true,
            ],
        ];

        User::insert($users);
    }
}

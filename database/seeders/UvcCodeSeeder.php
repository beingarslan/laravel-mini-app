<?php

namespace Database\Seeders;

use App\Models\UvcCode;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UvcCodeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Factory::create();

        $uvc_codes = [];

        for ($i=0; $i < rand(100,200); $i++) {
            $uvc_codes[] = [
                'uvc' => Str::random(8),
                'is_used' => rand(0, 1)
            ];
        }

        UvcCode::insert($uvc_codes);
    }
}

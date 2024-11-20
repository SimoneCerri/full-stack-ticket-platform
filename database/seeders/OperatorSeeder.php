<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Operator;
use Faker\Factory as Faker;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 10; $i++) {
            Operator::create([
                'name' => $faker->name,
                'surname' => $faker->name,
                'status' => $faker->boolean,
            ]);
        }
    }
}

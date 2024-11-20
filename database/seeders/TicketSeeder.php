<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ticket;
use App\Models\Operator;
use App\Models\Category;
use Faker\Factory as Faker;

class TicketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        for ($i = 0; $i < 100; $i++) {
            Ticket::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'status' => $faker->randomElement(['ASSIGNED', 'IN_PROGRESS', 'CLOSED']),
                'category_id' => Category::inRandomOrder()->first()->id,
                'operator_id' => Operator::inRandomOrder()->first()->id,
            ]);
        }
    }
}

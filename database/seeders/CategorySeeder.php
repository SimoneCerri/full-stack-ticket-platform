<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $categories = [
            'PHP',
            'HTML',
            'CSS',
            'JAVASCRIPT',
            'BOOTSTRAP',
            'SASS',
            'VUEJS',
            'VITE',
            'LARAVEL',
            'MYSQL',
        ];

        foreach ($categories as $category) {
            Category::create([
                'name' => $category,
            ]);
        }
    }
}

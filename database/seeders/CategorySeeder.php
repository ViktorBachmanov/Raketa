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
    public function run(): void
    {
        Category::firstOrCreate(
            ['id' => 1],
            ['name' => 'Столы']
        );

        Category::firstOrCreate(
            ['id' => 2],
            ['name' => 'Стулья']
        );

        Category::firstOrCreate(
            ['id' => 3],
            ['name' => 'Банкетки']
        );

        Category::firstOrCreate(
            ['id' => 4],
            ['name' => 'Комоды']
        );

        Category::firstOrCreate(
            ['id' => 5],
            ['name' => 'Стеллажи']
        );
    }
}

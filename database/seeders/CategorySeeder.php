<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Category;
use App\Enums\Category as CategoryEnum;


class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate(
            ['id' => 1],
            ['name' => CategoryEnum::Tables->value]
        );

        Category::firstOrCreate(
            ['id' => 2],
            ['name' => CategoryEnum::Chairs->value]
        );

        Category::firstOrCreate(
            ['id' => 3],
            ['name' => CategoryEnum::Banquettes->value]
        );

        Category::firstOrCreate(
            ['id' => 4],
            ['name' => CategoryEnum::Commodes->value]
        );

        Category::firstOrCreate(
            ['id' => 5],
            ['name' => CategoryEnum::Stacks->value]
        );
    }
}

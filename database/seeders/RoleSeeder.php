<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Role;
use App\Enums\Role as RoleEnum;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate(
            ['id' => 1],
            ['name' => RoleEnum::Manager->value]
        );

        Role::firstOrCreate(
            ['id' => 2],
            ['name' => RoleEnum::Employee->value]
        );
    }
}

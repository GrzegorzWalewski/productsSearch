<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PackageTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('package_types')->insert([
            ['name' => 'roll'],
            ['name' => 'package'],
            ['name' => 'box'],
            ['name' => 'pallet'],
            ['name' => 'piece'],
        ]);
    }
}

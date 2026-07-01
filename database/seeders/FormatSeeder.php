<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Format::firstOrCreate(['name' => 'CD']);
        \App\Models\Format::firstOrCreate(['name' => 'Kaset']);
    }
}

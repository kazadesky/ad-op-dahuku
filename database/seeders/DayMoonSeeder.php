<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DayMoonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table("days")->insert([
            [
                'name' => 'Senin',
            ],
            [
                'name' => 'Selasa',
            ],
            [
                'name' => 'Rabu',
            ],
            [
                'name' => 'Kamis',
            ],
            [
                'name' => 'Jumat',
            ],
            [
                'name' => 'Sabtu',
            ],
        ]);

        DB::table("moons")->insert([
            [
                'name' => 'Januari',
            ],
            [
                'name' => 'Februari',
            ],
            [
                'name' => 'Maret',
            ],
            [
                'name' => 'April',
            ],
            [
                'name' => 'Mei',
            ],
            [
                'name' => 'Juni',
            ],
            [
                'name' => 'Juli',
            ],
            [
                'name' => 'Agustus',
            ],
            [
                'name' => 'September',
            ],
            [
                'name' => 'Oktober',
            ],
            [
                'name' => 'November',
            ],
            [
                'name' => 'Desember',
            ],
        ]);
    }
}

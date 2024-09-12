<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            DayMoonSeeder::class,
        ]);

        $superAdminSeeder = User::factory()->create([
            'email' => 'superadmin@example.com',
        ]);
        $superAdminSeeder->assignRole('super_admin');

        $adminSeeder = User::factory()->create([
            'email' => 'admin@example.com',
        ]);
        $adminSeeder->assignRole('admin');

        $operatorSeeder = User::factory()->create([
            'email' => 'operator@example.com',
        ]);
        $operatorSeeder->assignRole('operator');
    }
}

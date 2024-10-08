<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
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
            RandomSeeder::class,
        ]);

        Student::factory()->count(150)->create();

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

        $teacherSeeder = User::factory()->create([
            'email' => 'teacher@example.com',
            'teacher_status' => 'Guru Dayah',
        ]);
        $teacherSeeder->assignRole('teacher');

        $teacher1Seeder = User::factory()->create([
            'email' => 'teacher1@example.com',
            'teacher_status' => 'Guru Umum',
        ]);
        $teacher1Seeder->assignRole('teacher');

        $teacher2Seeder = User::factory()->create([
            'email' => 'teacher2@example.com',
            'teacher_status' => 'Guru Dayah',
        ]);
        $teacher2Seeder->assignRole('teacher');
    }
}

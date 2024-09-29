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

        // Membuat 250 siswa dan secara otomatis mengaitkan mereka dengan kelas secara acak
        Student::factory()->count(250)->create();

        // Membuat pengguna dengan peran yang telah ditentukan
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
    }
}

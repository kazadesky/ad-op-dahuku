<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'nis' => $this->faker->unique()->numerify('##########'),
            'nisn' => $this->faker->unique()->numerify('######'),
            // Mengaitkan siswa dengan salah satu kelas yang ada secara acak
            'class_id' => ClassRoom::inRandomOrder()->first()->id,
            'place_of_birth' => $this->faker->city,
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'gender' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'address' => $this->faker->address,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Student>
 */
class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Student::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'nis' => $this->faker->unique()->numerify('##########'),
            'nisn' => $this->faker->unique()->numerify('######'),
            'class_id' => ClassRoom::factory(),
            'place_of_birth' => $this->faker->city,
            'date_of_birth' => $this->faker->date('Y-m-d'),
            'gender' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'address' => $this->faker->address,
        ];
    }
}

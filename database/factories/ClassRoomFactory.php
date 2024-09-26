<?php

namespace Database\Factories;

use App\Models\ClassRoom;
use Illuminate\Database\Eloquent\Factories\Factory;

class ClassRoomFactory extends Factory
{
    protected $model = ClassRoom::class;

    public function definition(): array
    {
        return [
            // Menentukan nama kelas hanya dari empat opsi ini
            'name' => $this->faker->unique()->randomElement(['Class A', 'Class B', 'Class C', 'Class D']),
        ];
    }
}

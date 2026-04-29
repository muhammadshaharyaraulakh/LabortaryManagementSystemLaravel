<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use App\Models\Department;

class UserFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'password' => Hash::make('password'),
            'role' => fake()->randomElement([
                'Receptionist',
                'SampleCollector',
                'Pathologist',
                'Technician',
                'SpecialistDoctor'
            ]),
            'department_id' => Department::query()->inRandomOrder()->value('id'),
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\Department;
use Illuminate\Database\Eloquent\Factories\Factory;


class DepartmentFactory extends Factory
{
    protected static $index = 0;

    public function definition(): array
    {
        $departments = [
            'Hematology',
            'Clinical Biochemistry',
            'Microbiology',
            'Clinical Pathology',
            'Immunology',
            'Serology',
            'Histopathology',
            'Cytopathology',
            'Molecular Biology',
            'Genetics',
            'Flow Cytometry',
            'Hormone Analysis',
            'Tumor Markers',
            'Coagulation',
            'Toxicology',
            'Therapeutic Drug Monitoring',
            'Virology',
            'Parasitology',
            'Mycology',
            'Infectious Diseases',
            'Blood Bank',
            'Transfusion Medicine',
            'Urinalysis',
            'Stool Analysis',
            'Body Fluid Analysis',
            'Radiology',
            'Ultrasound',
            'X-Ray',
            'CT Scan',
            'MRI',
            'Health Checkup Packages',
            'Preventive Screening',
            'Emergency Lab',
            'STAT Testing'
        ];
        $name = $departments[self::$index % count($departments)];
        self::$index++;

        return [
            'name' => $name,
            'type' => $this->faker->randomElement(['sample_based', 'human_based']),
            'is_active' => true,
        ];
    }
}
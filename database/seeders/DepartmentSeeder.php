<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;

class DepartmentSeeder extends Seeder
{
    public function run(): void
    {
        $departments = [
            // Sample-Based Clinical Lab Departments
            [
                'name' => 'Hematology',
                'type' => 'sample_based',
                'is_active' => true,
            ],
            [
                'name' => 'Biochemistry',
                'type' => 'sample_based',
                'is_active' => true,
            ],
            [
                'name' => 'Immunology & Serology',
                'type' => 'sample_based',
                'is_active' => true,
            ],
            [
                'name' => 'Molecular Biology & PCR',
                'type' => 'sample_based',
                'is_active' => true,
            ],
            [
                'name' => 'Histopathology & Cytology',
                'type' => 'sample_based',
                'is_active' => true,
            ],

            // Human-Based Diagnostic & Imaging Departments
            [
                'name' => 'Cardiology & ECG',
                'type' => 'human_based',
                'is_active' => true,
            ],
            [
                'name' => 'Ultrasound & Sonography',
                'type' => 'human_based',
                'is_active' => true,
            ],
            [
                'name' => 'Computed Tomography (CT Scan)',
                'type' => 'human_based',
                'is_active' => true,
            ],
            [
                'name' => 'Pulmonology & Spirometry',
                'type' => 'human_based',
                'is_active' => true,
            ],
            [
                'name' => 'Neurophysiology & EEG',
                'type' => 'human_based',
                'is_active' => true,
            ],
        ];

        foreach ($departments as $dept) {
            Department::firstOrCreate(
                ['name' => $dept['name']],
                [
                    'type' => $dept['type'],
                    'is_active' => $dept['is_active'],
                ]
            );
        }
    }
}

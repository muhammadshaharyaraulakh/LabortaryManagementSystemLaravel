<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Test;
use App\Models\Department;
use App\Models\User;
use App\Models\Inventory;
use App\Models\TestParameter;
use App\Models\TestRequirement;

class TestFactory extends Factory
{
    protected static $index = 0;

    public function definition(): array
    {
        $tests = [
            ['name' => 'Complete Blood Count (CBC)', 'code' => 'HEM-001', 'sampleType' => 'Blood (EDTA)', 'price' => 800],
            ['name' => 'Hemoglobin (Hb)', 'code' => 'HEM-002', 'sampleType' => 'Blood (EDTA)', 'price' => 300],
            ['name' => 'ESR', 'code' => 'HEM-003', 'sampleType' => 'Blood (EDTA)', 'price' => 350],
            ['name' => 'Peripheral Blood Film', 'code' => 'HEM-004', 'sampleType' => 'Blood (EDTA)', 'price' => 600],
            ['name' => 'Platelet Count', 'code' => 'HEM-005', 'sampleType' => 'Blood (EDTA)', 'price' => 400],
            ['name' => 'Prothrombin Time (PT)', 'code' => 'HEM-006', 'sampleType' => 'Blood (Citrate)', 'price' => 900],
            ['name' => 'APTT', 'code' => 'HEM-007', 'sampleType' => 'Blood (Citrate)', 'price' => 900],
            ['name' => 'Blood Group & Rh Factor', 'code' => 'HEM-008', 'sampleType' => 'Blood', 'price' => 500],
            ['name' => 'Liver Function Test (LFT)', 'code' => 'BIO-001', 'sampleType' => 'Blood Serum', 'price' => 1200],
            ['name' => 'Renal Function Test (RFT)', 'code' => 'BIO-002', 'sampleType' => 'Blood Serum', 'price' => 1100],
            ['name' => 'Lipid Profile', 'code' => 'BIO-003', 'sampleType' => 'Blood Serum', 'price' => 1500],
            ['name' => 'Blood Glucose Fasting', 'code' => 'BIO-004', 'sampleType' => 'Blood Fluoride', 'price' => 400],
            ['name' => 'Blood Glucose Random', 'code' => 'BIO-005', 'sampleType' => 'Blood Fluoride', 'price' => 400],
            ['name' => 'HbA1c', 'code' => 'BIO-006', 'sampleType' => 'Blood (EDTA)', 'price' => 1800],
            ['name' => 'Urea', 'code' => 'BIO-007', 'sampleType' => 'Blood Serum', 'price' => 500],
            ['name' => 'Creatinine', 'code' => 'BIO-008', 'sampleType' => 'Blood Serum', 'price' => 500],
            ['name' => 'Uric Acid', 'code' => 'BIO-009', 'sampleType' => 'Blood Serum', 'price' => 500],
            ['name' => 'Total Cholesterol', 'code' => 'BIO-010', 'sampleType' => 'Blood Serum', 'price' => 500],
            ['name' => 'Triglycerides', 'code' => 'BIO-011', 'sampleType' => 'Blood Serum', 'price' => 500],
            ['name' => 'HDL Cholesterol', 'code' => 'BIO-012', 'sampleType' => 'Blood Serum', 'price' => 500],
            ['name' => 'LDL Cholesterol', 'code' => 'BIO-013', 'sampleType' => 'Blood Serum', 'price' => 500],
            ['name' => 'Thyroid Profile (T3 T4 TSH)', 'code' => 'IMM-001', 'sampleType' => 'Blood Serum', 'price' => 2500],
            ['name' => 'TSH', 'code' => 'IMM-002', 'sampleType' => 'Blood Serum', 'price' => 900],
            ['name' => 'Free T3', 'code' => 'IMM-003', 'sampleType' => 'Blood Serum', 'price' => 900],
            ['name' => 'Free T4', 'code' => 'IMM-004', 'sampleType' => 'Blood Serum', 'price' => 900],
            ['name' => 'Beta HCG', 'code' => 'IMM-005', 'sampleType' => 'Blood Serum', 'price' => 1200],
            ['name' => 'Vitamin D', 'code' => 'IMM-006', 'sampleType' => 'Blood Serum', 'price' => 3500],
            ['name' => 'Vitamin B12', 'code' => 'IMM-007', 'sampleType' => 'Blood Serum', 'price' => 2500],
            ['name' => 'CRP', 'code' => 'IMM-008', 'sampleType' => 'Blood Serum', 'price' => 900],
            ['name' => 'Urine Routine Examination', 'code' => 'PAT-001', 'sampleType' => 'Urine', 'price' => 500],
            ['name' => 'Urine Culture', 'code' => 'MIC-001', 'sampleType' => 'Urine', 'price' => 1500],
            ['name' => 'Stool Routine Examination', 'code' => 'PAT-002', 'sampleType' => 'Stool', 'price' => 600],
            ['name' => 'Stool Culture', 'code' => 'MIC-002', 'sampleType' => 'Stool', 'price' => 1500],
            ['name' => 'Semen Analysis', 'code' => 'PAT-003', 'sampleType' => 'Semen', 'price' => 1800],
            ['name' => 'Blood Culture', 'code' => 'MIC-003', 'sampleType' => 'Blood', 'price' => 2500],
            ['name' => 'Hepatitis B (HBsAg)', 'code' => 'SER-001', 'sampleType' => 'Blood Serum', 'price' => 1200],
            ['name' => 'Hepatitis C (Anti HCV)', 'code' => 'SER-002', 'sampleType' => 'Blood Serum', 'price' => 1400],
            ['name' => 'HIV I & II', 'code' => 'SER-003', 'sampleType' => 'Blood Serum', 'price' => 1500],
            ['name' => 'Typhoid (ICT)', 'code' => 'SER-004', 'sampleType' => 'Blood Serum', 'price' => 700],
            ['name' => 'Malaria Parasite', 'code' => 'SER-005', 'sampleType' => 'Blood', 'price' => 600],
            ['name' => 'Dengue NS1', 'code' => 'SER-006', 'sampleType' => 'Blood Serum', 'price' => 1800],
            ['name' => 'COVID-19 Antigen', 'code' => 'SER-007', 'sampleType' => 'Swab', 'price' => 2000],
            ['name' => 'RA Factor', 'code' => 'IMM-009', 'sampleType' => 'Blood Serum', 'price' => 900],
            ['name' => 'ASO Titer', 'code' => 'IMM-010', 'sampleType' => 'Blood Serum', 'price' => 900]
        ];

        $test = $tests[self::$index % count($tests)];
        self::$index++;

        return [
            'name' => $test['name'],
            'code' => $test['code'],
            'price' => $test['price'],
            'sampleType' => $test['sampleType'],
            'resultHours' => $this->faker->randomElement([12, 24, 48]),
            'instructions' => 'Fasting recommended for optimal results.',
            'isActive' => true,
            'departmentId' => Department::inRandomOrder()->first()->id ?? 1,
            'userId' => User::inRandomOrder()->first()->id ?? 1,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Test $test) {
            $parameters = [];

            switch ($test->name) {
                case 'Complete Blood Count (CBC)':
                    $parameters = [
                        ['parameterName' => 'Hemoglobin', 'unit' => 'g/dL', 'normalRange' => '13 - 17'],
                        ['parameterName' => 'WBC', 'unit' => '10^3/uL', 'normalRange' => '4 - 11'],
                        ['parameterName' => 'Platelets', 'unit' => '10^3/uL', 'normalRange' => '150 - 450'],
                        ['parameterName' => 'RBC', 'unit' => '10^6/uL', 'normalRange' => '4.5 - 5.9'],
                        ['parameterName' => 'Hematocrit', 'unit' => '%', 'normalRange' => '40 - 50'],
                    ];
                    break;
                case 'Hemoglobin (Hb)':
                    $parameters = [['parameterName' => 'Hemoglobin', 'unit' => 'g/dL', 'normalRange' => '13 - 17']];
                    break;
                case 'ESR':
                    $parameters = [['parameterName' => 'ESR', 'unit' => 'mm/hr', 'normalRange' => '0 - 20']];
                    break;
                case 'Liver Function Test (LFT)':
                    $parameters = [
                        ['parameterName' => 'Bilirubin Total', 'unit' => 'mg/dL', 'normalRange' => '0.1 - 1.2'],
                        ['parameterName' => 'ALT', 'unit' => 'U/L', 'normalRange' => '7 - 56'],
                        ['parameterName' => 'AST', 'unit' => 'U/L', 'normalRange' => '10 - 40'],
                        ['parameterName' => 'ALP', 'unit' => 'U/L', 'normalRange' => '44 - 147'],
                    ];
                    break;
                case 'Renal Function Test (RFT)':
                    $parameters = [
                        ['parameterName' => 'Urea', 'unit' => 'mg/dL', 'normalRange' => '15 - 45'],
                        ['parameterName' => 'Creatinine', 'unit' => 'mg/dL', 'normalRange' => '0.6 - 1.3'],
                        ['parameterName' => 'Uric Acid', 'unit' => 'mg/dL', 'normalRange' => '3.5 - 7.2'],
                    ];
                    break;
                case 'Lipid Profile':
                    $parameters = [
                        ['parameterName' => 'Total Cholesterol', 'unit' => 'mg/dL', 'normalRange' => '<200'],
                        ['parameterName' => 'Triglycerides', 'unit' => 'mg/dL', 'normalRange' => '<150'],
                        ['parameterName' => 'HDL', 'unit' => 'mg/dL', 'normalRange' => '>40'],
                        ['parameterName' => 'LDL', 'unit' => 'mg/dL', 'normalRange' => '<100'],
                    ];
                    break;
                case 'Thyroid Profile (T3 T4 TSH)':
                    $parameters = [
                        ['parameterName' => 'T3', 'unit' => 'ng/mL', 'normalRange' => '0.8 - 2.0'],
                        ['parameterName' => 'T4', 'unit' => 'ug/dL', 'normalRange' => '5 - 12'],
                        ['parameterName' => 'TSH', 'unit' => 'uIU/mL', 'normalRange' => '0.4 - 4.0'],
                    ];
                    break;
                case 'Blood Glucose Fasting':
                    $parameters = [['parameterName' => 'Fasting Glucose', 'unit' => 'mg/dL', 'normalRange' => '70 - 100']];
                    break;
                case 'Blood Glucose Random':
                    $parameters = [['parameterName' => 'Random Glucose', 'unit' => 'mg/dL', 'normalRange' => '70 - 140']];
                    break;
                case 'HbA1c':
                    $parameters = [['parameterName' => 'HbA1c', 'unit' => '%', 'normalRange' => '4 - 5.6']];
                    break;
                case 'Urine Routine Examination':
                    $parameters = [
                        ['parameterName' => 'Color', 'unit' => '-', 'normalRange' => 'Yellow'],
                        ['parameterName' => 'pH', 'unit' => '', 'normalRange' => '4.5 - 8'],
                        ['parameterName' => 'Protein', 'unit' => '', 'normalRange' => 'Negative'],
                        ['parameterName' => 'Sugar', 'unit' => '', 'normalRange' => 'Negative'],
                    ];
                    break;
                case 'Stool Routine Examination':
                    $parameters = [
                        ['parameterName' => 'Color', 'unit' => '-', 'normalRange' => 'Brown'],
                        ['parameterName' => 'Consistency', 'unit' => '-', 'normalRange' => 'Soft'],
                        ['parameterName' => 'Parasites', 'unit' => '-', 'normalRange' => 'Absent'],
                    ];
                    break;
                case 'Hepatitis B (HBsAg)':
                case 'Hepatitis C (Anti HCV)':
                case 'HIV I & II':
                case 'Typhoid (ICT)':
                case 'Malaria Parasite':
                case 'Dengue NS1':
                case 'COVID-19 Antigen':
                    $parameters = [['parameterName' => 'Result', 'unit' => '-', 'normalRange' => 'Negative']];
                    break;
                case 'Vitamin D':
                    $parameters = [['parameterName' => 'Vitamin D', 'unit' => 'ng/mL', 'normalRange' => '30 - 100']];
                    break;
                case 'Vitamin B12':
                    $parameters = [['parameterName' => 'Vitamin B12', 'unit' => 'pg/mL', 'normalRange' => '200 - 900']];
                    break;
                default:
                    $parameters = [['parameterName' => 'Result', 'unit' => '', 'normalRange' => 'Normal']];
            }

            foreach ($parameters as $param) {
                TestParameter::create(array_merge($param, ['testId' => $test->id]));
            }

            $inventories = Inventory::inRandomOrder()->take(rand(1, 2))->get();
            foreach ($inventories as $inventory) {
                TestRequirement::create([
                    'testId' => $test->id,
                    'inventoryId' => $inventory->id,
                    'quantityUsed' => rand(1, 3),
                ]);
            }
        });
    }
}
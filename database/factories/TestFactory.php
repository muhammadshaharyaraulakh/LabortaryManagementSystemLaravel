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
            // Sample Based Tests
            ['name' => 'Complete Blood Count (CBC)', 'code' => 'HEM-001', 'sampleType' => 'Blood (EDTA)', 'price' => 800, 'type' => 'sample_based'],
            ['name' => 'Hemoglobin (Hb)', 'code' => 'HEM-002', 'sampleType' => 'Blood (EDTA)', 'price' => 300, 'type' => 'sample_based'],
            ['name' => 'ESR', 'code' => 'HEM-003', 'sampleType' => 'Blood (EDTA)', 'price' => 350, 'type' => 'sample_based'],
            ['name' => 'Peripheral Blood Film', 'code' => 'HEM-004', 'sampleType' => 'Blood (EDTA)', 'price' => 600, 'type' => 'sample_based'],
            ['name' => 'Platelet Count', 'code' => 'HEM-005', 'sampleType' => 'Blood (EDTA)', 'price' => 400, 'type' => 'sample_based'],
            ['name' => 'Prothrombin Time (PT)', 'code' => 'HEM-006', 'sampleType' => 'Blood (Citrate)', 'price' => 900, 'type' => 'sample_based'],
            ['name' => 'APTT', 'code' => 'HEM-007', 'sampleType' => 'Blood (Citrate)', 'price' => 900, 'type' => 'sample_based'],
            ['name' => 'Blood Group & Rh Factor', 'code' => 'HEM-008', 'sampleType' => 'Blood', 'price' => 500, 'type' => 'sample_based'],
            ['name' => 'Liver Function Test (LFT)', 'code' => 'BIO-001', 'sampleType' => 'Blood Serum', 'price' => 1200, 'type' => 'sample_based'],
            ['name' => 'Renal Function Test (RFT)', 'code' => 'BIO-002', 'sampleType' => 'Blood Serum', 'price' => 1100, 'type' => 'sample_based'],
            ['name' => 'Lipid Profile', 'code' => 'BIO-003', 'sampleType' => 'Blood Serum', 'price' => 1500, 'type' => 'sample_based'],
            ['name' => 'Blood Glucose Fasting', 'code' => 'BIO-004', 'sampleType' => 'Blood Fluoride', 'price' => 400, 'type' => 'sample_based'],
            ['name' => 'Blood Glucose Random', 'code' => 'BIO-005', 'sampleType' => 'Blood Fluoride', 'price' => 400, 'type' => 'sample_based'],
            ['name' => 'HbA1c', 'code' => 'BIO-006', 'sampleType' => 'Blood (EDTA)', 'price' => 1800, 'type' => 'sample_based'],
            ['name' => 'Urea', 'code' => 'BIO-007', 'sampleType' => 'Blood Serum', 'price' => 500, 'type' => 'sample_based'],
            ['name' => 'Creatinine', 'code' => 'BIO-008', 'sampleType' => 'Blood Serum', 'price' => 500, 'type' => 'sample_based'],
            ['name' => 'Uric Acid', 'code' => 'BIO-009', 'sampleType' => 'Blood Serum', 'price' => 500, 'type' => 'sample_based'],
            ['name' => 'Total Cholesterol', 'code' => 'BIO-010', 'sampleType' => 'Blood Serum', 'price' => 500, 'type' => 'sample_based'],
            ['name' => 'Triglycerides', 'code' => 'BIO-011', 'sampleType' => 'Blood Serum', 'price' => 500, 'type' => 'sample_based'],
            ['name' => 'HDL Cholesterol', 'code' => 'BIO-012', 'sampleType' => 'Blood Serum', 'price' => 500, 'type' => 'sample_based'],
            ['name' => 'LDL Cholesterol', 'code' => 'BIO-013', 'sampleType' => 'Blood Serum', 'price' => 500, 'type' => 'sample_based'],
            ['name' => 'Thyroid Profile (T3 T4 TSH)', 'code' => 'IMM-001', 'sampleType' => 'Blood Serum', 'price' => 2500, 'type' => 'sample_based'],
            ['name' => 'TSH', 'code' => 'IMM-002', 'sampleType' => 'Blood Serum', 'price' => 900, 'type' => 'sample_based'],
            ['name' => 'Free T3', 'code' => 'IMM-003', 'sampleType' => 'Blood Serum', 'price' => 900, 'type' => 'sample_based'],
            ['name' => 'Free T4', 'code' => 'IMM-004', 'sampleType' => 'Blood Serum', 'price' => 900, 'type' => 'sample_based'],
            ['name' => 'Beta HCG', 'code' => 'IMM-005', 'sampleType' => 'Blood Serum', 'price' => 1200, 'type' => 'sample_based'],
            ['name' => 'Vitamin D', 'code' => 'IMM-006', 'sampleType' => 'Blood Serum', 'price' => 3500, 'type' => 'sample_based'],
            ['name' => 'Vitamin B12', 'code' => 'IMM-007', 'sampleType' => 'Blood Serum', 'price' => 2500, 'type' => 'sample_based'],
            ['name' => 'CRP', 'code' => 'IMM-008', 'sampleType' => 'Blood Serum', 'price' => 900, 'type' => 'sample_based'],
            ['name' => 'Urine Routine Examination', 'code' => 'PAT-001', 'sampleType' => 'Urine', 'price' => 500, 'type' => 'sample_based'],
            ['name' => 'Urine Culture', 'code' => 'MIC-001', 'sampleType' => 'Urine', 'price' => 1500, 'type' => 'sample_based'],
            ['name' => 'Stool Routine Examination', 'code' => 'PAT-002', 'sampleType' => 'Stool', 'price' => 600, 'type' => 'sample_based'],
            ['name' => 'Stool Culture', 'code' => 'MIC-002', 'sampleType' => 'Stool', 'price' => 1500, 'type' => 'sample_based'],
            ['name' => 'Semen Analysis', 'code' => 'PAT-003', 'sampleType' => 'Semen', 'price' => 1800, 'type' => 'sample_based'],
            ['name' => 'Blood Culture', 'code' => 'MIC-003', 'sampleType' => 'Blood', 'price' => 2500, 'type' => 'sample_based'],
            ['name' => 'Hepatitis B (HBsAg)', 'code' => 'SER-001', 'sampleType' => 'Blood Serum', 'price' => 1200, 'type' => 'sample_based'],
            ['name' => 'Hepatitis C (Anti HCV)', 'code' => 'SER-002', 'sampleType' => 'Blood Serum', 'price' => 1400, 'type' => 'sample_based'],
            ['name' => 'HIV I & II', 'code' => 'SER-003', 'sampleType' => 'Blood Serum', 'price' => 1500, 'type' => 'sample_based'],
            ['name' => 'Typhoid (ICT)', 'code' => 'SER-004', 'sampleType' => 'Blood Serum', 'price' => 700, 'type' => 'sample_based'],
            ['name' => 'Malaria Parasite', 'code' => 'SER-005', 'sampleType' => 'Blood', 'price' => 600, 'type' => 'sample_based'],
            ['name' => 'Dengue NS1', 'code' => 'SER-006', 'sampleType' => 'Blood Serum', 'price' => 1800, 'type' => 'sample_based'],
            ['name' => 'COVID-19 Antigen', 'code' => 'SER-007', 'sampleType' => 'Swab', 'price' => 2000, 'type' => 'sample_based'],
            ['name' => 'RA Factor', 'code' => 'IMM-009', 'sampleType' => 'Blood Serum', 'price' => 900, 'type' => 'sample_based'],
            ['name' => 'ASO Titer', 'code' => 'IMM-010', 'sampleType' => 'Blood Serum', 'price' => 900, 'type' => 'sample_based'],

            // Human Based Tests
            ['name' => 'X-Ray Chest PA View', 'code' => 'RAD-001', 'sampleType' => 'None', 'price' => 1500, 'type' => 'human_based'],
            ['name' => 'X-Ray KUB', 'code' => 'RAD-002', 'sampleType' => 'None', 'price' => 1200, 'type' => 'human_based'],
            ['name' => 'Ultrasound Abdomen', 'code' => 'ULT-001', 'sampleType' => 'None', 'price' => 2000, 'type' => 'human_based'],
            ['name' => 'MRI Brain', 'code' => 'MRI-001', 'sampleType' => 'None', 'price' => 8000, 'type' => 'human_based'],
            ['name' => 'CT Scan Head', 'code' => 'CT-001', 'sampleType' => 'None', 'price' => 5000, 'type' => 'human_based'],
            ['name' => 'ECG', 'code' => 'CAR-001', 'sampleType' => 'None', 'price' => 500, 'type' => 'human_based'],
            ['name' => 'Echocardiography', 'code' => 'CAR-002', 'sampleType' => 'None', 'price' => 3000, 'type' => 'human_based'],
            ['name' => 'Mammography', 'code' => 'RAD-003', 'sampleType' => 'None', 'price' => 2500, 'type' => 'human_based'],
            ['name' => 'DEXA Scan', 'code' => 'RAD-004', 'sampleType' => 'None', 'price' => 3500, 'type' => 'human_based'],
            ['name' => 'EEG', 'code' => 'NEU-001', 'sampleType' => 'None', 'price' => 2000, 'type' => 'human_based'],
        ];

        $test = $tests[self::$index % count($tests)];
        self::$index++;

        $type = $test['type'] ?? 'sample_based';
        $department = Department::where('type', $type)->inRandomOrder()->first();

        return [
            'name' => $test['name'],
            'code' => $test['code'],
            'price' => $test['price'],
            'sampleType' => $test['sampleType'],
            'resultHours' => $this->faker->randomElement([12, 24, 48]),
            'instructions' => 'No specific preparation is required for a standard Complete Blood Count (CBC). You may eat and drink normally unless your doctor has ordered additional tests that require fasting. Please wear a shirt with loose-fitting sleeves that can be easily rolled up, and stay well-hydrated to make the blood draw easier.',
            'Instructions(SampleCollector)' => '1. Collect whole blood via standard venipuncture into a Lavender/Purple-top tube (EDTA anticoagulant). 2. Fill the tube completely to the designated mark to ensure the correct blood-to-additive ratio. 3. Immediately and gently invert the tube 8-10 times to prevent micro-clotting—DO NOT SHAKE. 4. Label the specimen immediately at the patient\'s side. 5. Transport and store at room temperature if analyzing within 24 hours.',
            'isActive' => true,
            'departmentId' => $department->id ?? 1,
            'userId' => User::inRandomOrder()->first()->id ?? 1,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Test $test) {
            $department = Department::find($test->departmentId);

            if (!$department || $department->type === 'human_based') {
                $inventories = Inventory::inRandomOrder()->take(rand(1, 2))->get();
                foreach ($inventories as $inventory) {
                    TestRequirement::create([
                        'testId' => $test->id,
                        'inventoryId' => $inventory->id,
                        'quantityUsed' => rand(1, 3),
                    ]);
                }
                return;
            }

            $parameters = [];

            switch ($test->name) {
                case 'Complete Blood Count (CBC)':
                    $parameters = [
                        ['parameterName' => 'Hemoglobin', 'inputType' => 'Quantitative', 'unit' => 'g/dL', 'normalRange' => '13 - 17'],
                        ['parameterName' => 'WBC', 'inputType' => 'Quantitative', 'unit' => '10^3/uL', 'normalRange' => '4 - 11'],
                        ['parameterName' => 'Platelets', 'inputType' => 'Quantitative', 'unit' => '10^3/uL', 'normalRange' => '150 - 450'],
                        ['parameterName' => 'RBC', 'inputType' => 'Quantitative', 'unit' => '10^6/uL', 'normalRange' => '4.5 - 5.9'],
                        ['parameterName' => 'Hematocrit', 'inputType' => 'Quantitative', 'unit' => '%', 'normalRange' => '40 - 50'],
                    ];
                    break;
                case 'Hemoglobin (Hb)':
                    $parameters = [['parameterName' => 'Hemoglobin', 'inputType' => 'Quantitative', 'unit' => 'g/dL', 'normalRange' => '13 - 17']];
                    break;
                case 'ESR':
                    $parameters = [['parameterName' => 'ESR', 'inputType' => 'Quantitative', 'unit' => 'mm/hr', 'normalRange' => '0 - 20']];
                    break;
                case 'Liver Function Test (LFT)':
                    $parameters = [
                        ['parameterName' => 'Bilirubin Total', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '0.1 - 1.2'],
                        ['parameterName' => 'ALT', 'inputType' => 'Quantitative', 'unit' => 'U/L', 'normalRange' => '7 - 56'],
                        ['parameterName' => 'AST', 'inputType' => 'Quantitative', 'unit' => 'U/L', 'normalRange' => '10 - 40'],
                        ['parameterName' => 'ALP', 'inputType' => 'Quantitative', 'unit' => 'U/L', 'normalRange' => '44 - 147'],
                    ];
                    break;
                case 'Renal Function Test (RFT)':
                    $parameters = [
                        ['parameterName' => 'Urea', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '15 - 45'],
                        ['parameterName' => 'Creatinine', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '0.6 - 1.3'],
                        ['parameterName' => 'Uric Acid', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '3.5 - 7.2'],
                    ];
                    break;
                case 'Lipid Profile':
                    $parameters = [
                        ['parameterName' => 'Total Cholesterol', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '<200'],
                        ['parameterName' => 'Triglycerides', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '<150'],
                        ['parameterName' => 'HDL', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '>40'],
                        ['parameterName' => 'LDL', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '<100'],
                    ];
                    break;
                case 'Thyroid Profile (T3 T4 TSH)':
                    $parameters = [
                        ['parameterName' => 'T3', 'inputType' => 'Quantitative', 'unit' => 'ng/mL', 'normalRange' => '0.8 - 2.0'],
                        ['parameterName' => 'T4', 'inputType' => 'Quantitative', 'unit' => 'ug/dL', 'normalRange' => '5 - 12'],
                        ['parameterName' => 'TSH', 'inputType' => 'Quantitative', 'unit' => 'uIU/mL', 'normalRange' => '0.4 - 4.0'],
                    ];
                    break;
                case 'Blood Glucose Fasting':
                    $parameters = [['parameterName' => 'Fasting Glucose', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '70 - 100']];
                    break;
                case 'Blood Glucose Random':
                    $parameters = [['parameterName' => 'Random Glucose', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '70 - 140']];
                    break;
                case 'HbA1c':
                    $parameters = [['parameterName' => 'HbA1c', 'inputType' => 'Quantitative', 'unit' => '%', 'normalRange' => '4 - 5.6']];
                    break;
                case 'Urine Routine Examination':
                    $parameters = [
                        ['parameterName' => 'Color', 'inputType' => 'Qualitative', 'options' => ['Yellow', 'Amber', 'Red'], 'unit' => '-', 'normalRange' => 'Yellow'],
                        ['parameterName' => 'pH', 'inputType' => 'Quantitative', 'unit' => '', 'normalRange' => '4.5 - 8'],
                        ['parameterName' => 'Protein', 'inputType' => 'Qualitative', 'options' => ['Negative', 'Trace', '1+', '2+'], 'unit' => '', 'normalRange' => 'Negative'],
                        ['parameterName' => 'Sugar', 'inputType' => 'Qualitative', 'options' => ['Negative', 'Trace', '1+', '2+'], 'unit' => '', 'normalRange' => 'Negative'],
                    ];
                    break;
                case 'Stool Routine Examination':
                    $parameters = [
                        ['parameterName' => 'Color', 'inputType' => 'Qualitative', 'options' => ['Brown', 'Green', 'Black', 'Red'], 'unit' => '-', 'normalRange' => 'Brown'],
                        ['parameterName' => 'Consistency', 'inputType' => 'Qualitative', 'options' => ['Soft', 'Hard', 'Watery'], 'unit' => '-', 'normalRange' => 'Soft'],
                        ['parameterName' => 'Parasites', 'inputType' => 'Qualitative', 'options' => ['Absent', 'Present'], 'unit' => '-', 'normalRange' => 'Absent'],
                    ];
                    break;
                case 'Hepatitis B (HBsAg)':
                case 'Hepatitis C (Anti HCV)':
                case 'HIV I & II':
                case 'Typhoid (ICT)':
                case 'Malaria Parasite':
                case 'Dengue NS1':
                case 'COVID-19 Antigen':
                    $parameters = [['parameterName' => 'Result', 'inputType' => 'Qualitative', 'options' => ['Negative', 'Positive'], 'unit' => '-', 'normalRange' => 'Negative']];
                    break;
                case 'Vitamin D':
                    $parameters = [['parameterName' => 'Vitamin D', 'inputType' => 'Quantitative', 'unit' => 'ng/mL', 'normalRange' => '30 - 100']];
                    break;
                case 'Vitamin B12':
                    $parameters = [['parameterName' => 'Vitamin B12', 'inputType' => 'Quantitative', 'unit' => 'pg/mL', 'normalRange' => '200 - 900']];
                    break;
                default:
                    $parameters = [['parameterName' => 'Result', 'inputType' => 'Quantitative', 'unit' => '', 'normalRange' => 'Normal']];
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
<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Order;
use App\Models\Test;
use App\Models\Result;
use App\Models\User;
use App\Models\Inventory;
use App\Models\InventoryLog;
use Carbon\Carbon;

class OrderWorkflowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Identify or prepare system actors (Roles)
        $receptionist = User::where('role', 'Receptionist')->first() ?? User::first();
        $sampleCollector = User::where('role', 'SampleCollector')->first() ?? $receptionist;
        $technician = User::where('role', 'Technician')->first() ?? $receptionist;
        
        // Pathologist for department 1 (sample_based Pathology)
        $pathologist = User::where('role', 'Pathologist')
            ->where('department_id', 1)
            ->first() ?? User::where('role', 'Pathologist')->first() ?? $receptionist;

        // Ensure Pathologist has a valid signature in DB
        $signaturePath = 'Signatures/1777895049_images.jpeg';
        if (empty($pathologist->signature)) {
            $pathologist->signature = $signaturePath;
            $pathologist->save();
        }

        // Ensure storage reports directory exists
        Storage::disk('public')->makeDirectory('reports');

        // 2. Define 10 realistic patient profiles and test sets
        $patientsData = [
            [
                'name' => 'Muhammad Ahmed',
                'phone' => '03001234501',
                'email' => 'ahmed.m@example.com',
                'age' => 32,
                'gender' => 'Male',
                'test_codes' => ['BIO-004', 'HEM-001'], // Fasting Glucose & CBC
            ],
            [
                'name' => 'Fatima Zahra',
                'phone' => '03011234502',
                'email' => 'fatima.zahra@example.com',
                'age' => 28,
                'gender' => 'Female',
                'test_codes' => ['BIO-001', 'BIO-002'], // LFT & RFT
            ],
            [
                'name' => 'Ali Raza',
                'phone' => '03021234503',
                'email' => 'ali.raza@example.com',
                'age' => 45,
                'gender' => 'Male',
                'test_codes' => ['BIO-003'], // Lipid Profile
            ],
            [
                'name' => 'Ayesha Khan',
                'phone' => '03031234504',
                'email' => 'ayesha.khan@example.com',
                'age' => 24,
                'gender' => 'Female',
                'test_codes' => ['HEM-001', 'HEM-008'], // CBC & Blood Group
            ],
            [
                'name' => 'Hamza Tariq',
                'phone' => '03041234505',
                'email' => 'hamza.tariq@example.com',
                'age' => 38,
                'gender' => 'Male',
                'test_codes' => ['BIO-006', 'BIO-004'], // HbA1c & Fasting Glucose
            ],
            [
                'name' => 'Zainab Bibi',
                'phone' => '03051234506',
                'email' => 'zainab.bibi@example.com',
                'age' => 52,
                'gender' => 'Female',
                'test_codes' => ['BIO-002', 'BIO-003'], // RFT & Lipid Profile
            ],
            [
                'name' => 'Bilal Hussain',
                'phone' => '03061234507',
                'email' => 'bilal.h@example.com',
                'age' => 29,
                'gender' => 'Male',
                'test_codes' => ['BIO-001'], // LFT
            ],
            [
                'name' => 'Sana Malik',
                'phone' => '03071234508',
                'email' => 'sana.malik@example.com',
                'age' => 34,
                'gender' => 'Female',
                'test_codes' => ['HEM-001', 'HEM-003'], // CBC & ESR
            ],
            [
                'name' => 'Usman Farooq',
                'phone' => '03081234509',
                'email' => 'usman.f@example.com',
                'age' => 50,
                'gender' => 'Male',
                'test_codes' => ['BIO-003', 'BIO-006'], // Lipid Profile & HbA1c
            ],
            [
                'name' => 'Maryam Nawaz',
                'phone' => '03091234510',
                'email' => 'maryam.nawaz@example.com',
                'age' => 41,
                'gender' => 'Female',
                'test_codes' => ['BIO-002', 'BIO-005'], // RFT & Random Glucose
            ],
        ];

        // 3. Clinical Parameter value generators
        $paramGenerators = [
            'Hemoglobin' => fn() => number_format(rand(135, 165) / 10, 1),
            'WBC' => fn() => number_format(rand(50, 95) / 10, 1),
            'Platelets' => fn() => (string) rand(180, 390),
            'RBC' => fn() => number_format(rand(46, 56) / 10, 1),
            'Hematocrit' => fn() => (string) rand(41, 49),
            'ESR' => fn() => (string) rand(5, 15),
            'Bilirubin Total' => fn() => number_format(rand(3, 10) / 10, 1),
            'ALT' => fn() => (string) rand(18, 42),
            'AST' => fn() => (string) rand(15, 36),
            'ALP' => fn() => (string) rand(65, 125),
            'Urea' => fn() => (string) rand(20, 39),
            'Creatinine' => fn() => number_format(rand(7, 12) / 10, 1),
            'Uric Acid' => fn() => number_format(rand(40, 65) / 10, 1),
            'Total Cholesterol' => fn() => (string) rand(145, 195),
            'Triglycerides' => fn() => (string) rand(85, 140),
            'HDL' => fn() => (string) rand(45, 65),
            'LDL' => fn() => (string) rand(65, 95),
            'Fasting Glucose' => fn() => (string) rand(75, 98),
            'Random Glucose' => fn() => (string) rand(95, 130),
            'HbA1c' => fn() => number_format(rand(46, 55) / 10, 1),
            'Result' => fn() => 'Normal',
        ];

        // 4. Create 10 full order workflows
        foreach ($patientsData as $index => $patient) {
            DB::beginTransaction();
            try {
                // Fetch tests for this order
                $tests = Test::whereIn('code', $patient['test_codes'])->get();
                if ($tests->isEmpty()) {
                    // Fallback to first available tests
                    $tests = Test::where('departmentId', 1)->take(2)->get();
                }

                $subtotal = $tests->sum('price');
                $discount = 0.00;
                $afterDiscount = $subtotal - $discount;
                $tax = round($afterDiscount * 0.05, 2);
                $grandTotal = $afterDiscount + $tax;

                $trackingId = 'ORD-' . date('Ymd') . '-' . strtoupper(Str::random(4));
                $fiaReceiptNo = 'FIA-TEST-' . uniqid() . rand(100000, 999999);

                // Step 1: Create Order
                $order = Order::create([
                    'trackingId' => $trackingId,
                    'name' => $patient['name'],
                    'phone' => $patient['phone'],
                    'age' => $patient['age'],
                    'email' => $patient['email'],
                    'gender' => $patient['gender'],
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'tax' => $tax,
                    'grandTotal' => $grandTotal,
                    'fiaReceiptNo' => $fiaReceiptNo,
                    'userId' => $receptionist->id,
                    'created_at' => Carbon::now()->subHours(rand(2, 6)),
                    'updated_at' => Carbon::now(),
                ]);

                // Step 2-5: Follow each test procedure
                foreach ($tests as $test) {
                    $vialBarcode = 'VIAL-' . $trackingId . '-' . $test->id . '-' . rand(1000, 9999);
                    $collectedAt = Carbon::now()->subMinutes(rand(60, 180));

                    // Step 2 & 3: Attach with Completed status, collection & technician tracking
                    $orderTestId = DB::table('order_test')->insertGetId([
                        'orderId' => $order->id,
                        'testId' => $test->id,
                        'status' => 'Completed',
                        'priceAtOrder' => $test->price,
                        'vialBarcode' => $vialBarcode,
                        'collectedAt' => $collectedAt,
                        'collectedBy' => $sampleCollector->id,
                        'testedBy' => $technician->id,
                        'created_at' => $collectedAt,
                        'updated_at' => Carbon::now(),
                    ]);

                    // Step 3 (Inventory): Deduct required stock and create inventory logs
                    $requirements = DB::table('test_requirements')->where('testId', $test->id)->get();
                    foreach ($requirements as $requirement) {
                        $inventory = Inventory::find($requirement->inventoryId);
                        if ($inventory) {
                            $inventory->current_stock = max(0, $inventory->current_stock - $requirement->quantityUsed);
                            $inventory->save();

                            InventoryLog::create([
                                'inventory_id' => $requirement->inventoryId,
                                'type' => 'Out',
                                'quantity' => $requirement->quantityUsed,
                                'action' => 'Test Conducted (OrderTestID: ' . $orderTestId . ')',
                                'created_by' => $technician->id,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                        }
                    }

                    // Step 4: Results Recording
                    $parameters = DB::table('test_parameters')->where('testId', $test->id)->get();
                    $createdResults = collect();

                    if ($parameters->isNotEmpty()) {
                        foreach ($parameters as $param) {
                            $generator = $paramGenerators[$param->parameterName] ?? (fn() => 'Normal');
                            $val = $generator();

                            $result = Result::create([
                                'orderTestId' => $orderTestId,
                                'testParameterId' => $param->id,
                                'trackingId' => $trackingId,
                                'resultValue' => $val,
                                'statusFlag' => 'Normal',
                                'remarks' => 'All parameters within normal biological reference interval. Verified by clinical pathologist.',
                                'signatureImagePath' => $pathologist->signature,
                                'alertPatient' => false,
                                'verifiedBy' => $pathologist->name,
                                'created_at' => Carbon::now(),
                                'updated_at' => Carbon::now(),
                            ]);
                            $createdResults->push($result);
                        }
                    } else {
                        // Non-parameter test
                        $result = Result::create([
                            'orderTestId' => $orderTestId,
                            'trackingId' => $trackingId,
                            'resultValue' => 'Normal',
                            'statusFlag' => 'Normal',
                            'remarks' => 'Observational clinical test conducted. Findings normal.',
                            'signatureImagePath' => $pathologist->signature,
                            'alertPatient' => false,
                            'verifiedBy' => $pathologist->name,
                            'created_at' => Carbon::now(),
                            'updated_at' => Carbon::now(),
                        ]);
                        $createdResults->push($result);
                    }

                    // Step 6: Generate and save PDF report to storage/app/public/reports
                    try {
                        $pdfResults = Result::where('orderTestId', $orderTestId)
                            ->with('parameter')
                            ->get();

                        $pdf = Pdf::loadView('TestReport', [
                            'order' => $order,
                            'test' => $test,
                            'results' => $pdfResults
                        ]);

                        $fileName = "reports/Report-{$order->trackingId}-{$test->name}.pdf";
                        Storage::disk('public')->put($fileName, $pdf->output());
                    } catch (\Exception $pdfEx) {
                        // In case of any PDF asset warning, continue gracefully
                    }
                }

                DB::commit();
                $this->command->info("Order " . ($index + 1) . "/10 created: [{$order->trackingId}] for {$order->name} with completed tests.");
            } catch (\Exception $e) {
                DB::rollBack();
                $this->command->error("Error seeding order " . ($index + 1) . ": " . $e->getMessage());
            }
        }

        $this->command->info("Successfully created 10 orders with all procedures, test results, and completed reports!");
    }
}

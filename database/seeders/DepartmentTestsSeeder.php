<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Test;
use App\Models\TestParameter;
use App\Models\TestRequirement;
use App\Models\User;

class DepartmentTestsSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::where('role', 'admin')->first() ?? User::first();
        $adminId = $adminUser ? $adminUser->id : 1;

        // 36 Comprehensive Diagnostic Tests across 12 Departments (excluding Pathology)
        $departmentsTests = [
            // ========================================================
            // 1. Radiology (ID: 2, human_based)
            // ========================================================
            'Radiology' => [
                [
                    'name' => 'Chest X-Ray PA View',
                    'code' => 'RAD-001',
                    'price' => 1500,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 2,
                    'instructions' => 'Remove all metallic objects, chains, necklaces, and clothing from the waist up. Wear the provided hospital gown.',
                    'Instructions(SampleCollector)' => 'Position patient upright against detector with anterior chest wall firmly touching the board, shoulders rolled forward. Instruct patient to take full inspiration and hold breath during exposure.',
                    'parameters' => [
                        ['parameterName' => 'Lung Fields', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Clear and well aerated', 'Infiltration noted', 'Consolidation observed', 'Patchy opacities']],
                        ['parameterName' => 'Cardiac Silhouette', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal transverse diameter', 'Cardiomegaly noted', 'Prominent aortic knuckle']],
                        ['parameterName' => 'Costophrenic Angles', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Sharp and clear bilaterally', 'Blunted right angle', 'Blunted left angle', 'Bilateral effusion']],
                        ['parameterName' => 'Bony Thoracic Cage', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Ribs and clavicles intact', 'Healed rib fracture', 'Osteopenia noted']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 15, 'quantityUsed' => 1], // Disposable Gloves Medium
                    ],
                ],
                [
                    'name' => 'X-Ray Lumbosacral (LS) Spine AP & Lateral',
                    'code' => 'RAD-002',
                    'price' => 2200,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 3,
                    'instructions' => 'Empty bladder before procedure. Remove belt buckles, zippered trousers, and metallic jewelry.',
                    'Instructions(SampleCollector)' => 'Obtain AP view with knees flexed to reduce lumbar lordosis. Obtain true lateral view centered at L3-L4 crest with radiopaque anatomical markers.',
                    'parameters' => [
                        ['parameterName' => 'Lumbar Lordotic Curvature', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal lordosis', 'Loss of normal lordosis (Spasm)', 'Exaggerated lordosis']],
                        ['parameterName' => 'Vertebral Body Heights', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Heights and alignment preserved', 'Mild L4 anterior compression', 'Degenerative endplate changes']],
                        ['parameterName' => 'Intervertebral Disc Spaces', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal disc spaces', 'L4-L5 disc space narrowing', 'L5-S1 disc space reduction']],
                        ['parameterName' => 'Sacroiliac Joints', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Bilateral SI joints unremarkable', 'Sclerosis noted', 'Joint space irregularity']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'X-Ray Knee Joint AP & Lateral (Standing)',
                    'code' => 'RAD-003',
                    'price' => 1800,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 2,
                    'instructions' => 'Wear comfortable trousers that can be rolled above knee or change into examination shorts.',
                    'Instructions(SampleCollector)' => 'Obtain weight-bearing anteroposterior projection and 20-30 degree flexed lateral projection. Center ray 1/2 inch below patellar apex.',
                    'parameters' => [
                        ['parameterName' => 'Tibiofemoral Joint Space', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Adequate joint space bilaterally', 'Medial joint compartment narrowing', 'Tricompartmental narrowing']],
                        ['parameterName' => 'Patellofemoral Alignment', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal patellar tracking', 'Lateral patellar subluxation', 'Patellar osteophytes']],
                        ['parameterName' => 'Joint Effusion & Soft Tissue', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No joint effusion noted', 'Suprapatellar joint effusion present', 'Soft tissue swelling']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 14, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 2. Microbiology (ID: 3, sample_based)
            // ========================================================
            'Microbiology:' => [
                [
                    'name' => 'Urine Culture & Sensitivity (C/S)',
                    'code' => 'MIC-001',
                    'price' => 1800,
                    'sampleType' => 'Mid-stream Urine',
                    'resultHours' => 48,
                    'instructions' => 'Collect early morning first clean-catch mid-stream urine in a sterile container after washing genital area. Avoid antibiotics 48 hours prior.',
                    'Instructions(SampleCollector)' => 'Check for sterile container seal. Ensure minimum 15-20ml volume. Inoculate onto CLED & MacConkey agar within 2 hours or store at 4°C.',
                    'parameters' => [
                        ['parameterName' => 'Bacterial Colony Count', 'inputType' => 'Quantitative', 'unit' => 'CFU/mL', 'normalRange' => '< 10000', 'options' => null],
                        ['parameterName' => 'Primary Organism Isolated', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No significant bacterial growth', 'Escherichia coli (E. coli)', 'Klebsiella pneumoniae', 'Proteus mirabilis', 'Enterococcus faecalis']],
                        ['parameterName' => 'Antibiotic Susceptibility Profile', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Sensitive to first-line agents', 'ESBL producer detected', 'Pan-sensitive', 'Multi-drug resistant (MDR)']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 18, 'quantityUsed' => 1], // Biohazard Bags
                        ['inventoryId' => 15, 'quantityUsed' => 1], // Disposable Gloves
                    ],
                ],
                [
                    'name' => 'Blood Culture & Sensitivity (Bactec Automated)',
                    'code' => 'MIC-002',
                    'price' => 2500,
                    'sampleType' => 'Whole Blood (Aseptic)',
                    'resultHours' => 72,
                    'instructions' => 'Ideally collect sample at earliest onset of fever spikes before commencing empirical antimicrobial therapy.',
                    'Instructions(SampleCollector)' => 'Disinfect venipuncture skin site with 70% alcohol followed by 2% Chlorhexidine/Betadine. Inoculate 8-10ml into aerobic and anaerobic Bactec blood culture vials under strict aseptic technique.',
                    'parameters' => [
                        ['parameterName' => 'Automated Growth Monitoring', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Sterile after 5 days incubation', 'Positive microbial growth detected', 'Contaminant / Skin flora']],
                        ['parameterName' => 'Direct Gram Stain from Bottle', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No microorganisms seen', 'Gram-positive cocci in clusters', 'Gram-negative bacilli', 'Gram-positive diplococci']],
                        ['parameterName' => 'Identified Pathogen', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No growth', 'Staphylococcus aureus', 'Salmonella typhi', 'Pseudomonas aeruginosa', 'Acinetobacter baumannii']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 4, 'quantityUsed' => 1], // 10cc Syringe
                        ['inventoryId' => 9, 'quantityUsed' => 2], // Alcohol Swabs
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Throat Swab Culture & Gram Stain',
                    'code' => 'MIC-003',
                    'price' => 1200,
                    'sampleType' => 'Throat Swab',
                    'resultHours' => 24,
                    'instructions' => 'Do not brush teeth, use antibacterial mouthwash, or ingest food/hot liquids for 2 hours before swab collection.',
                    'Instructions(SampleCollector)' => 'Depress tongue firmly using sterile spatula. Vigorously swab posterior pharyngeal wall and tonsillar pillars avoiding mucosal contact with buccal cavity, tongue, or lips.',
                    'parameters' => [
                        ['parameterName' => 'Gram Stain Direct Smear', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal upper respiratory flora', 'Gram-positive cocci in chains with pus cells', 'Yeast cells and pseudohyphae seen']],
                        ['parameterName' => 'Culture Identification', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal throat commensals only', 'Streptococcus pyogenes (Group A Beta-hemolytic)', 'Candida albicans', 'Staphylococcus aureus']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 10, 'quantityUsed' => 1], // Cotton Balls
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 3. Hematology (ID: 4, sample_based)
            // ========================================================
            'Hematology' => [
                [
                    'name' => 'Coagulation Profile (PT, INR, APTT)',
                    'code' => 'HEM-101',
                    'price' => 1400,
                    'sampleType' => 'Citrated Plasma (Light Blue Top)',
                    'resultHours' => 4,
                    'instructions' => 'Inform laboratory personnel if taking oral anticoagulant drugs (Warfarin, NOACs) or Aspirin/Heparin.',
                    'Instructions(SampleCollector)' => 'Draw blood into 3.2% buffered sodium citrate tube precisely to indicator fill line (9:1 blood to anticoagulant ratio). Invert gently 4-5 times. Centrifuge within 30 minutes at 1500g for 15 min.',
                    'parameters' => [
                        ['parameterName' => 'Prothrombin Time (PT)', 'inputType' => 'Quantitative', 'unit' => 'seconds', 'normalRange' => '11.0 - 14.0', 'options' => null],
                        ['parameterName' => 'International Normalized Ratio (INR)', 'inputType' => 'Quantitative', 'unit' => 'ratio', 'normalRange' => '0.85 - 1.15', 'options' => null],
                        ['parameterName' => 'Activated Partial Thromboplastin Time (APTT)', 'inputType' => 'Quantitative', 'unit' => 'seconds', 'normalRange' => '25.0 - 36.0', 'options' => null],
                        ['parameterName' => 'Control Plasma Time', 'inputType' => 'Quantitative', 'unit' => 'seconds', 'normalRange' => '12.0 - 13.5', 'options' => null],
                    ],
                    'requirements' => [
                        ['inventoryId' => 2, 'quantityUsed' => 1], // 3cc Syringe
                        ['inventoryId' => 9, 'quantityUsed' => 1], // Alcohol Swabs
                        ['inventoryId' => 8, 'quantityUsed' => 1], // Tourniquet
                    ],
                ],
                [
                    'name' => 'Reticulocyte Count & Index',
                    'code' => 'HEM-102',
                    'price' => 900,
                    'sampleType' => 'Blood (EDTA)',
                    'resultHours' => 6,
                    'instructions' => 'No special dietary fasting needed. Routine blood draw.',
                    'Instructions(SampleCollector)' => 'Collect 3ml whole blood in K2/K3 EDTA purple top tube. Invert 8 times immediately to prevent micro-clotting.',
                    'parameters' => [
                        ['parameterName' => 'Reticulocyte Percentage', 'inputType' => 'Quantitative', 'unit' => '%', 'normalRange' => '0.5 - 2.5', 'options' => null],
                        ['parameterName' => 'Absolute Reticulocyte Count (ARC)', 'inputType' => 'Quantitative', 'unit' => '10^3/uL', 'normalRange' => '25 - 100', 'options' => null],
                        ['parameterName' => 'Corrected Reticulocyte Index (CRI)', 'inputType' => 'Quantitative', 'unit' => 'index', 'normalRange' => '1.0 - 2.0', 'options' => null],
                    ],
                    'requirements' => [
                        ['inventoryId' => 20, 'quantityUsed' => 1], // EDTA Tube
                        ['inventoryId' => 2, 'quantityUsed' => 1],
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Complete Iron Studies Profile (Fe, TIBC, Ferritin)',
                    'code' => 'HEM-103',
                    'price' => 2600,
                    'sampleType' => 'Serum (Yellow/Red Top)',
                    'resultHours' => 8,
                    'instructions' => 'Overnight 12-hour fasting required. Iron levels peak in morning. Discontinue oral iron tablets for 48 hours prior to sampling.',
                    'Instructions(SampleCollector)' => 'Draw 5ml blood into plain or gel separator tube early morning (8:00 AM - 10:00 AM). Allow complete clot retraction for 20-30 min before spinning.',
                    'parameters' => [
                        ['parameterName' => 'Serum Iron', 'inputType' => 'Quantitative', 'unit' => 'ug/dL', 'normalRange' => '60 - 170', 'options' => null],
                        ['parameterName' => 'Total Iron Binding Capacity (TIBC)', 'inputType' => 'Quantitative', 'unit' => 'ug/dL', 'normalRange' => '240 - 450', 'options' => null],
                        ['parameterName' => 'Transferrin Saturation', 'inputType' => 'Quantitative', 'unit' => '%', 'normalRange' => '20.0 - 50.0', 'options' => null],
                        ['parameterName' => 'Serum Ferritin', 'inputType' => 'Quantitative', 'unit' => 'ng/mL', 'normalRange' => '30 - 300', 'options' => null],
                    ],
                    'requirements' => [
                        ['inventoryId' => 3, 'quantityUsed' => 1], // 5cc Syringe
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                        ['inventoryId' => 12, 'quantityUsed' => 1], // Bandages
                    ],
                ],
            ],

            // ========================================================
            // 4. Biochemistry (ID: 5, sample_based)
            // ========================================================
            'Biochemistry' => [
                [
                    'name' => 'Serum Electrolytes Panel (Na, K, Cl, HCO3)',
                    'code' => 'BIO-101',
                    'price' => 1200,
                    'sampleType' => 'Serum',
                    'resultHours' => 2,
                    'instructions' => 'Fasting not required unless instructed in conjunction with fasting blood sugar.',
                    'Instructions(SampleCollector)' => 'Collect 4ml venous blood. Release tourniquet within 1 minute of venipuncture to prevent pseudo-hyperkalemia. Prevent specimen hemolysis.',
                    'parameters' => [
                        ['parameterName' => 'Sodium (Na+)', 'inputType' => 'Quantitative', 'unit' => 'mEq/L', 'normalRange' => '136 - 145', 'options' => null],
                        ['parameterName' => 'Potassium (K+)', 'inputType' => 'Quantitative', 'unit' => 'mEq/L', 'normalRange' => '3.5 - 5.1', 'options' => null],
                        ['parameterName' => 'Chloride (Cl-)', 'inputType' => 'Quantitative', 'unit' => 'mEq/L', 'normalRange' => '98 - 107', 'options' => null],
                        ['parameterName' => 'Bicarbonate (HCO3-)', 'inputType' => 'Quantitative', 'unit' => 'mEq/L', 'normalRange' => '22 - 29', 'options' => null],
                    ],
                    'requirements' => [
                        ['inventoryId' => 2, 'quantityUsed' => 1],
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Comprehensive Renal Profile (RFT with eGFR)',
                    'code' => 'BIO-102',
                    'price' => 1500,
                    'sampleType' => 'Serum',
                    'resultHours' => 3,
                    'instructions' => 'Avoid strenuous physical activity and heavy meat meals 24 hours before test. Drink water normally.',
                    'Instructions(SampleCollector)' => 'Collect 5ml whole blood in gold-top SST tube. Centrifuge after clot formation. Check for icterus or lipemia.',
                    'parameters' => [
                        ['parameterName' => 'Blood Urea Nitrogen (BUN)', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '7 - 20', 'options' => null],
                        ['parameterName' => 'Serum Creatinine', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '0.7 - 1.3', 'options' => null],
                        ['parameterName' => 'Serum Uric Acid', 'inputType' => 'Quantitative', 'unit' => 'mg/dL', 'normalRange' => '3.5 - 7.2', 'options' => null],
                        ['parameterName' => 'Estimated GFR (CKD-EPI)', 'inputType' => 'Quantitative', 'unit' => 'mL/min/1.73m2', 'normalRange' => '90 - 120', 'options' => null],
                    ],
                    'requirements' => [
                        ['inventoryId' => 3, 'quantityUsed' => 1],
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Cardiac Biomarkers Panel (hs-cTnI, CK-MB, LDH)',
                    'code' => 'BIO-103',
                    'price' => 3200,
                    'sampleType' => 'Heparin Plasma / Serum',
                    'resultHours' => 1,
                    'instructions' => 'Emergency STAT test for patients with acute chest pain, dyspnea, or suspected myocardial infarction.',
                    'Instructions(SampleCollector)' => 'STAT draw. Use green-top Lithium Heparin tube or gold SST. Transport immediately via pneumatic tube or hand-deliver directly to chemistry bench.',
                    'parameters' => [
                        ['parameterName' => 'High-Sensitivity Troponin-I', 'inputType' => 'Quantitative', 'unit' => 'ng/mL', 'normalRange' => '0.000 - 0.040', 'options' => null],
                        ['parameterName' => 'Creatine Kinase-MB (CK-MB)', 'inputType' => 'Quantitative', 'unit' => 'U/L', 'normalRange' => '0 - 25', 'options' => null],
                        ['parameterName' => 'Lactate Dehydrogenase (LDH)', 'inputType' => 'Quantitative', 'unit' => 'U/L', 'normalRange' => '140 - 280', 'options' => null],
                    ],
                    'requirements' => [
                        ['inventoryId' => 3, 'quantityUsed' => 1],
                        ['inventoryId' => 7, 'quantityUsed' => 1], // Butterfly Needle
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 5. Immunology & Serology (ID: 6, sample_based)
            // ========================================================
            'Immunology & Serology' => [
                [
                    'name' => 'Viral Hepatitis Screening (HBsAg & Anti-HCV)',
                    'code' => 'IMM-001',
                    'price' => 2200,
                    'sampleType' => 'Serum',
                    'resultHours' => 4,
                    'instructions' => 'No fasting required. Maintain normal diet.',
                    'Instructions(SampleCollector)' => 'Draw 5ml blood in plain red-top or yellow SST. Exercise strict universal biohazard precautions. Place in labeled biohazard container.',
                    'parameters' => [
                        ['parameterName' => 'Hepatitis B Surface Antigen (HBsAg)', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Non-Reactive', 'Reactive', 'Borderline / Retest Recommended']],
                        ['parameterName' => 'Anti-Hepatitis C Virus Antibody (Anti-HCV)', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Non-Reactive', 'Reactive', 'Borderline / Retest Recommended']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 3, 'quantityUsed' => 1],
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                        ['inventoryId' => 18, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Thyroid Hormones Profile (TSH, Free T3, Free T4)',
                    'code' => 'IMM-002',
                    'price' => 2800,
                    'sampleType' => 'Serum',
                    'resultHours' => 6,
                    'instructions' => 'Morning blood draw recommended. If taking synthetic thyroid medication (Levothyroxine), take dose after blood sampling.',
                    'Instructions(SampleCollector)' => 'Collect 4ml venous blood into SST tube. Invert 5 times, allow 30 min clotting, centrifuge at 2000 rpm for 10 min.',
                    'parameters' => [
                        ['parameterName' => 'Thyroid Stimulating Hormone (TSH)', 'inputType' => 'Quantitative', 'unit' => 'uIU/mL', 'normalRange' => '0.40 - 4.20', 'options' => null],
                        ['parameterName' => 'Free Triiodothyronine (FT3)', 'inputType' => 'Quantitative', 'unit' => 'pg/mL', 'normalRange' => '2.30 - 4.20', 'options' => null],
                        ['parameterName' => 'Free Thyroxine (FT4)', 'inputType' => 'Quantitative', 'unit' => 'ng/dL', 'normalRange' => '0.80 - 1.80', 'options' => null],
                    ],
                    'requirements' => [
                        ['inventoryId' => 3, 'quantityUsed' => 1],
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Autoimmune Arthritis Panel (RF, Anti-CCP, hs-CRP)',
                    'code' => 'IMM-003',
                    'price' => 3500,
                    'sampleType' => 'Serum',
                    'resultHours' => 8,
                    'instructions' => 'Overnight fasting for 8-10 hours is advised for optimal serum clarity and accurate immunoassay nephelometry.',
                    'Instructions(SampleCollector)' => 'Collect 5ml blood. Strictly avoid lipemic or hemolyzed specimens which can cause antibody optical interference.',
                    'parameters' => [
                        ['parameterName' => 'Rheumatoid Factor (RF Quantitative)', 'inputType' => 'Quantitative', 'unit' => 'IU/mL', 'normalRange' => '0 - 14', 'options' => null],
                        ['parameterName' => 'Anti-Cyclic Citrullinated Peptide (Anti-CCP)', 'inputType' => 'Quantitative', 'unit' => 'U/mL', 'normalRange' => '0 - 20', 'options' => null],
                        ['parameterName' => 'High Sensitivity C-Reactive Protein (hs-CRP)', 'inputType' => 'Quantitative', 'unit' => 'mg/L', 'normalRange' => '0.0 - 5.0', 'options' => null],
                    ],
                    'requirements' => [
                        ['inventoryId' => 3, 'quantityUsed' => 1],
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 6. Molecular Biology & PCR (ID: 7, sample_based)
            // ========================================================
            'Molecular Biology & PCR' => [
                [
                    'name' => 'HCV RNA Quantitative Real-Time PCR (Viral Load)',
                    'code' => 'MOL-001',
                    'price' => 6500,
                    'sampleType' => 'Plasma (EDTA - Cold Chain)',
                    'resultHours' => 48,
                    'instructions' => 'No specific diet restrictions. Inform lab if currently receiving direct-acting antiviral (DAA) therapy.',
                    'Instructions(SampleCollector)' => 'Draw 6ml whole blood into sterile EDTA tubes. Separate plasma within 2 hours of collection. Freeze plasma aliquot at -20°C. Transport on dry ice or cold pack.',
                    'parameters' => [
                        ['parameterName' => 'HCV RNA Viral Load (IU/mL)', 'inputType' => 'Quantitative', 'unit' => 'IU/mL', 'normalRange' => '0 - 15', 'options' => null],
                        ['parameterName' => 'HCV Log10 Value', 'inputType' => 'Quantitative', 'unit' => 'Log IU/mL', 'normalRange' => '0.0 - 1.2', 'options' => null],
                        ['parameterName' => 'Molecular Qualitative Result', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Target Not Detected (Below 15 IU/mL)', 'Target Detected (Active Viremia)', 'Detected Below Quantifiable Limit']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 4, 'quantityUsed' => 1], // 10cc Syringe
                        ['inventoryId' => 20, 'quantityUsed' => 2], // EDTA Tubes
                        ['inventoryId' => 18, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'HBV DNA Quantitative Real-Time PCR',
                    'code' => 'MOL-002',
                    'price' => 6000,
                    'sampleType' => 'Plasma (EDTA)',
                    'resultHours' => 48,
                    'instructions' => 'Maintain normal food and fluid intake prior to blood collection.',
                    'Instructions(SampleCollector)' => 'Draw 6ml venous blood in EDTA purple tube. Centrifuge at 1600g for 15 min. Pipette plasma into sterile screw-cap cryovial. Store frozen.',
                    'parameters' => [
                        ['parameterName' => 'HBV DNA Viral Load (IU/mL)', 'inputType' => 'Quantitative', 'unit' => 'IU/mL', 'normalRange' => '0 - 20', 'options' => null],
                        ['parameterName' => 'HBV Log10 Value', 'inputType' => 'Quantitative', 'unit' => 'Log IU/mL', 'normalRange' => '0.0 - 1.3', 'options' => null],
                        ['parameterName' => 'Clinical Viral Status', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Target Not Detected', 'Low Viral Replication (< 2000 IU/mL)', 'High Viral Replication (> 20,000 IU/mL)']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 4, 'quantityUsed' => 1],
                        ['inventoryId' => 20, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Mycobacterium Tuberculosis (MTB) GeneXpert PCR',
                    'code' => 'MOL-003',
                    'price' => 4500,
                    'sampleType' => 'Sputum / Bronchial Lavage',
                    'resultHours' => 6,
                    'instructions' => 'Collect early morning deep productive sputum cough after rinsing mouth with clean tap water. Saliva or nasal secretions are unacceptable.',
                    'Instructions(SampleCollector)' => 'Ensure sample is coughed directly into sterile 50ml Falcon screw-cap container. Minimum volume 2-4ml. Decontaminate container exterior with 1:10 bleach before bagging.',
                    'parameters' => [
                        ['parameterName' => 'MTB Complex Detection', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['MTB NOT DETECTED', 'MTB DETECTED (Very Low)', 'MTB DETECTED (Low)', 'MTB DETECTED (Medium)', 'MTB DETECTED (High)']],
                        ['parameterName' => 'Rifampicin Drug Resistance (rpoB gene)', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Resistance NOT DETECTED', 'Resistance DETECTED', 'Indeterminate / Retest Recommended']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 17, 'quantityUsed' => 1], // Face Mask
                        ['inventoryId' => 18, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 7. Histopathology & Cytology (ID: 8, sample_based)
            // ========================================================
            'Histopathology & Cytology' => [
                [
                    'name' => 'Fine Needle Aspiration Cytology (FNAC)',
                    'code' => 'HIS-001',
                    'price' => 3000,
                    'sampleType' => 'Aspirated Cell Suspension',
                    'resultHours' => 24,
                    'instructions' => 'No fasting needed. Notify practitioner if taking blood-thinners or if swelling is painful.',
                    'Instructions(SampleCollector)' => 'Cleanse nodule site with antiseptic. Perform 2-3 passes using 23G/25G needle with or without suction. Smear immediately onto glass slides; fix in 95% ethyl alcohol.',
                    'parameters' => [
                        ['parameterName' => 'Specimen Adequacy', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Adequate and satisfactory for evaluation', 'Suboptimal cellularity', 'Unsatisfactory due to blood contamination']],
                        ['parameterName' => 'Cytomorphological Findings', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Benign proliferative lesion', 'Atypical cells of undetermined significance (AUS)', 'Suspicious for malignancy', 'Malignant cells present']],
                        ['parameterName' => 'Diagnostic Category', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Colloid Nodule (Bethesda II)', 'Fibroadenoma', 'Reactive Follicular Hyperplasia', 'Ductal Carcinoma']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 2, 'quantityUsed' => 1],
                        ['inventoryId' => 7, 'quantityUsed' => 1],
                        ['inventoryId' => 9, 'quantityUsed' => 2],
                    ],
                ],
                [
                    'name' => 'Surgical Biopsy Histopathology (Small / Medium Tissue)',
                    'code' => 'HIS-002',
                    'price' => 4500,
                    'sampleType' => 'Formalin-Fixed Tissue',
                    'resultHours' => 72,
                    'instructions' => 'Submit complete clinical history, anatomical site, operative findings, and prior pathology reports.',
                    'Instructions(SampleCollector)' => 'Immediately place surgically excised tissue in 10% Neutral Buffered Formalin at a minimum ratio of 10:1 (formalin volume to tissue volume). Secure lid tightly.',
                    'parameters' => [
                        ['parameterName' => 'Specimen Gross Description', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Single nodular soft tissue biopsy', 'Multiple punch biopsy fragments', 'Excisional polypoid mass']],
                        ['parameterName' => 'Microscopic Histopathological Diagnosis', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal histological architecture', 'Chronic non-specific granulomatous inflammation', 'Dysplasia (Low Grade)', 'Invasive Well-Differentiated Adenocarcinoma']],
                        ['parameterName' => 'Surgical Resection Margins', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['All surgical margins clear of lesion', 'Margin involved by lesion', 'Not applicable (Incidental biopsy)']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                        ['inventoryId' => 18, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Cervical Pap Smear (Liquid-Based Cytology - LBC)',
                    'code' => 'HIS-003',
                    'price' => 2500,
                    'sampleType' => 'Cervical Brush Suspension',
                    'resultHours' => 48,
                    'instructions' => 'Avoid sexual intercourse, vaginal creams, douching, or tampons 48 hours prior. Schedule test 10-14 days after onset of menses.',
                    'Instructions(SampleCollector)' => 'Expose cervix under speculum illumination. Insert endocervical broom into external os; rotate 360 degrees 5 times clockwise. Vigorously swish broom into preservative vial and seal.',
                    'parameters' => [
                        ['parameterName' => 'Specimen Adequacy Status', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Satisfactory for evaluation (Endocervical component present)', 'Satisfactory (Endocervical component absent)', 'Unsatisfactory due to obscuring inflammation']],
                        ['parameterName' => 'Bethesda Epithelial Classification', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Negative for Intraepithelial Lesion or Malignancy (NILM)', 'Atypical Squamous Cells (ASC-US)', 'Low-Grade Squamous Intraepithelial Lesion (LSIL)', 'High-Grade Squamous Intraepithelial Lesion (HSIL)']],
                        ['parameterName' => 'Microbial Organisms Observed', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['None seen (Normal flora)', 'Bacterial vaginosis (Shift in flora)', 'Candida species morphological forms', 'Trichomonas vaginalis']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                        ['inventoryId' => 18, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 8. Cardiology & ECG (ID: 9, human_based)
            // ========================================================
            'Cardiology & ECG' => [
                [
                    'name' => '12-Lead Resting Electrocardiogram (ECG)',
                    'code' => 'CARD-001',
                    'price' => 1000,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 1,
                    'instructions' => 'Avoid caffeinated beverages and smoking for 2 hours before examination. Wear easily removable clothing.',
                    'Instructions(SampleCollector)' => 'Cleanse electrode sites with alcohol wipes. Attach 4 limb clamps and 6 precordial chest suction electrodes (V1-V6) anatomically. Ensure baseline filter on 0.05-150Hz. Record 10s rhythm strip.',
                    'parameters' => [
                        ['parameterName' => 'Heart Rate', 'inputType' => 'Quantitative', 'unit' => 'bpm', 'normalRange' => '60 - 100', 'options' => null],
                        ['parameterName' => 'PR Interval', 'inputType' => 'Quantitative', 'unit' => 'ms', 'normalRange' => '120 - 200', 'options' => null],
                        ['parameterName' => 'QRS Complex Duration', 'inputType' => 'Quantitative', 'unit' => 'ms', 'normalRange' => '70 - 110', 'options' => null],
                        ['parameterName' => 'Corrected QT Interval (QTc)', 'inputType' => 'Quantitative', 'unit' => 'ms', 'normalRange' => '350 - 440', 'options' => null],
                        ['parameterName' => 'Underlying Cardiac Rhythm', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal Sinus Rhythm', 'Sinus Tachycardia', 'Sinus Bradycardia', 'Atrial Fibrillation with Controlled Response']],
                        ['parameterName' => 'ST-Segment & T-Wave Morphology', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal ST-T wave pattern', 'Non-specific ST depression', 'T-wave inversion in lateral leads', 'ST-segment elevation']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 9, 'quantityUsed' => 2],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Transthoracic Echocardiography with Color Doppler (2D Echo)',
                    'code' => 'CARD-002',
                    'price' => 4500,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 2,
                    'instructions' => 'No fasting needed. Continue taking all standard cardiac medications unless specifically instructed otherwise.',
                    'Instructions(SampleCollector)' => 'Position patient in left lateral decubitus position. Apply acoustic ultrasound coupling gel. Acquire standard parasternal long/short axis, apical 4/2 chamber views with pulsed and color Doppler interrogation.',
                    'parameters' => [
                        ['parameterName' => 'Left Ventricular Ejection Fraction (LVEF)', 'inputType' => 'Quantitative', 'unit' => '%', 'normalRange' => '55.0 - 70.0', 'options' => null],
                        ['parameterName' => 'Left Ventricle Internal Diastolic Dimension (LVIDd)', 'inputType' => 'Quantitative', 'unit' => 'mm', 'normalRange' => '35.0 - 53.0', 'options' => null],
                        ['parameterName' => 'Interventricular Septal Thickness (IVSd)', 'inputType' => 'Quantitative', 'unit' => 'mm', 'normalRange' => '6.0 - 11.0', 'options' => null],
                        ['parameterName' => 'Left Atrial End-Systolic Dimension (LA)', 'inputType' => 'Quantitative', 'unit' => 'mm', 'normalRange' => '27.0 - 40.0', 'options' => null],
                        ['parameterName' => 'Valvular Hemodynamics', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal physiological valve motion', 'Mild Mitral Regurgitation (Grade I)', 'Aortic Valve Sclerosis', 'Tricuspid Regurgitation with Normal PASP']],
                        ['parameterName' => 'Regional Wall Motion Analysis', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No regional wall motion abnormality (RWMA)', 'Hypokinesia of inferior wall', 'Hypokinesia of anterior septum']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 10, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => '24-Hour Ambulatory Holter ECG Monitoring',
                    'code' => 'CARD-003',
                    'price' => 5000,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 24,
                    'instructions' => 'Take a bath prior to appointment since monitor cannot be submerged in water. Keep a written journal of daily activities and symptoms.',
                    'Instructions(SampleCollector)' => 'Prep skin with mild abrasive alcohol pad. Attach 5-lead or 7-lead chest sensor electrodes securely with micropore tape. Connect digital recorder; verify clear baseline signal on all channels.',
                    'parameters' => [
                        ['parameterName' => 'Average Heart Rate', 'inputType' => 'Quantitative', 'unit' => 'bpm', 'normalRange' => '60 - 90', 'options' => null],
                        ['parameterName' => 'Minimum Recorded Heart Rate', 'inputType' => 'Quantitative', 'unit' => 'bpm', 'normalRange' => '45 - 60', 'options' => null],
                        ['parameterName' => 'Maximum Recorded Heart Rate', 'inputType' => 'Quantitative', 'unit' => 'bpm', 'normalRange' => '110 - 150', 'options' => null],
                        ['parameterName' => 'Total Ventricular Ectopic Beats (VEBs)', 'inputType' => 'Quantitative', 'unit' => 'beats', 'normalRange' => '0 - 50', 'options' => null],
                        ['parameterName' => 'Total Supraventricular Ectopic Beats (SVEBs)', 'inputType' => 'Quantitative', 'unit' => 'beats', 'normalRange' => '0 - 100', 'options' => null],
                        ['parameterName' => 'Clinically Significant Pauses (> 2.0s)', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No significant pauses recorded', 'Isolated pause 2.1 - 2.5s (Sleep)', 'Frequent sinus pauses noted']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 9, 'quantityUsed' => 4],
                        ['inventoryId' => 13, 'quantityUsed' => 1], // Micropore Tape
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 9. Ultrasound & Sonography (ID: 10, human_based)
            // ========================================================
            'Ultrasound & Sonography' => [
                [
                    'name' => 'Ultrasound Whole Abdomen & Pelvis',
                    'code' => 'USG-001',
                    'price' => 2500,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 2,
                    'instructions' => 'Fasting for 6-8 hours required for optimal gallbladder visualization. Drink 4-5 glasses of water 1 hour before test to ensure full urinary bladder.',
                    'Instructions(SampleCollector)' => 'Perform systematic scan in supine and decubitus positions using 3.5MHz curvilinear probe. Interrogate liver, GB, pancreas, spleen, kidneys, urinary bladder, and pelvic organs.',
                    'parameters' => [
                        ['parameterName' => 'Liver Size and Echotexture', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal size and homogenous echotexture', 'Grade I diffuse fatty infiltration', 'Grade II diffuse fatty infiltration', 'Hepatomegaly with coarsened echo']],
                        ['parameterName' => 'Gallbladder & Biliary Tree', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Thin wall, lumen clear of calculi', 'Cholelithiasis (Gallbladder calculus noted)', 'Biliary sludge present', 'Thickened GB wall (Cholecystitis)']],
                        ['parameterName' => 'Spleen Longitudinal Span', 'inputType' => 'Quantitative', 'unit' => 'cm', 'normalRange' => '8.0 - 12.0', 'options' => null],
                        ['parameterName' => 'Right Kidney Length', 'inputType' => 'Quantitative', 'unit' => 'cm', 'normalRange' => '9.0 - 12.0', 'options' => null],
                        ['parameterName' => 'Left Kidney Length', 'inputType' => 'Quantitative', 'unit' => 'cm', 'normalRange' => '9.0 - 12.0', 'options' => null],
                        ['parameterName' => 'Urinary Bladder & Pelvic Organs', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Well distended, smooth wall, no mass/calculus', 'Prostatomegaly noted (Male)', 'Uterine fibroid noted (Female)', 'Post-void residual urine significant']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 11, 'quantityUsed' => 1], // Gauze Pads
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Obstetric Ultrasound (Fetal Anomaly & Growth Scan)',
                    'code' => 'USG-002',
                    'price' => 3000,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 2,
                    'instructions' => 'Comfortable two-piece clothing recommended. Moderately full bladder helpful in second trimester scans.',
                    'Instructions(SampleCollector)' => 'Scan with warmed gel. Measure standard biometric parameters (BPD, HC, AC, FL). Perform detailed structural review of cranium, heart, spine, kidneys, and abdominal wall.',
                    'parameters' => [
                        ['parameterName' => 'Fetal Heart Rate (FHR)', 'inputType' => 'Quantitative', 'unit' => 'bpm', 'normalRange' => '120 - 160', 'options' => null],
                        ['parameterName' => 'Estimated Fetal Weight (Hadlock)', 'inputType' => 'Quantitative', 'unit' => 'grams', 'normalRange' => '1500 - 3800', 'options' => null],
                        ['parameterName' => 'Amniotic Fluid Index (AFI)', 'inputType' => 'Quantitative', 'unit' => 'cm', 'normalRange' => '8.0 - 18.0', 'options' => null],
                        ['parameterName' => 'Placental Location & Grade', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Anterior placenta Grade I', 'Posterior placenta Grade II', 'Fundal placenta Grade I', 'Low lying placenta (Previa)']],
                        ['parameterName' => 'Gross Fetal Structural Anatomy', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No gross congenital anomaly detected', 'Intact fetal cranial vault and midline echo', '4-chamber cardiac view normal', 'Spine and extremities well visualized']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 11, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Carotid Arteries Color Doppler Ultrasound (Bilateral)',
                    'code' => 'USG-003',
                    'price' => 4000,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 3,
                    'instructions' => 'Wear open-neck shirt without necklaces. Fasting is not required.',
                    'Instructions(SampleCollector)' => 'Examine bilateral CCA, ICA, ECA, and vertebral arteries with high-frequency 7-12MHz linear transducer. Measure intimal-medial thickness (IMT) and spectral peak systolic velocities.',
                    'parameters' => [
                        ['parameterName' => 'Right Internal Carotid PSV', 'inputType' => 'Quantitative', 'unit' => 'cm/s', 'normalRange' => '40.0 - 125.0', 'options' => null],
                        ['parameterName' => 'Left Internal Carotid PSV', 'inputType' => 'Quantitative', 'unit' => 'cm/s', 'normalRange' => '40.0 - 125.0', 'options' => null],
                        ['parameterName' => 'Common Carotid Intima-Media Thickness (IMT)', 'inputType' => 'Quantitative', 'unit' => 'mm', 'normalRange' => '0.40 - 0.80', 'options' => null],
                        ['parameterName' => 'Atherosclerotic Plaque / Stenosis Assessment', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No hemodynamically significant stenosis (<50%)', 'Moderate internal carotid stenosis (50-69%)', 'Severe internal carotid stenosis (>70%)', 'Smooth non-calcified fibrofatty plaque noted']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 11, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 10. Computed Tomography (CT Scan) (ID: 11, human_based)
            // ========================================================
            'Computed Tomography (CT Scan)' => [
                [
                    'name' => 'CT Brain / Head Non-Contrast Examination',
                    'code' => 'CT-001',
                    'price' => 6500,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 4,
                    'instructions' => 'Remove dentures, hearing aids, hairpins, and eyeglasses prior to table positioning.',
                    'Instructions(SampleCollector)' => 'Secure patient head symmetrically in scanner head-holder. Align laser along orbitomeatal line (OML). Acquire 5mm contiguous axial slices from skull base through vertex.',
                    'parameters' => [
                        ['parameterName' => 'Brain Parenchymal Attenuation', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal gray-white matter differentiation', 'Acute hyperdense intracranial hemorrhage', 'Hypodense acute/subacute ischemic infarct', 'Space occupying lesion with surrounding edema']],
                        ['parameterName' => 'Ventricular System & Basal Cisterns', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Ventricular system symmetrical and age-appropriate', 'Ventricular dilatation (Hydrocephalus)', 'Compression / effacement of lateral ventricle']],
                        ['parameterName' => 'Midline Shift Dimension', 'inputType' => 'Quantitative', 'unit' => 'mm', 'normalRange' => '0.0 - 0.0', 'options' => null],
                        ['parameterName' => 'Cranial Bone Windows', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Calvarium and skull base intact', 'Linear calvarial fracture noted', 'Depressed skull fracture']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 17, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'High-Resolution CT (HRCT) Chest / Lungs',
                    'code' => 'CT-002',
                    'price' => 8500,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 4,
                    'instructions' => 'Wear metal-free clothing. Practice deep inspiratory breath-holding for 10-15 seconds before scanning.',
                    'Instructions(SampleCollector)' => 'Scan from lung apices down through costophrenic sulci during maximal deep inspiratory breath-hold. Reconstruct images with sharp high-spatial frequency lung algorithm at 1mm slice thickness.',
                    'parameters' => [
                        ['parameterName' => 'Pulmonary Parenchymal Findings', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Both lungs clear and normally expanded', 'Ground-glass opacities (GGO) noted', 'Fibrotic reticulation and subpleural honeycombing', 'Consolidation with air bronchograms']],
                        ['parameterName' => 'Tracheobronchial Tree Caliber', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal bronchial caliber and taper', 'Cylindrical bronchiectasis noted', 'Bronchial wall thickening present']],
                        ['parameterName' => 'Mediastinal Lymphadenopathy', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No significant mediastinal or hilar lymphadenopathy', 'Subcarinal lymph node enlargement > 10mm', 'Pretracheal lymphadenopathy']],
                        ['parameterName' => 'Pleural Spaces', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No pleural effusion or pneumothorax', 'Right sided pleural effusion', 'Left sided pleural effusion', 'Apical pleural thickening']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 17, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'CT Abdomen & Pelvis with Intravenous Contrast',
                    'code' => 'CT-003',
                    'price' => 12000,
                    'sampleType' => 'Patient Procedure (IV Contrast)',
                    'resultHours' => 6,
                    'instructions' => 'Fasting for 6 hours mandatory. Recent serum creatinine report (< 1.3 mg/dL) required for safe contrast clearance. Drink oral contrast 1 hour before examination.',
                    'Instructions(SampleCollector)' => 'Cannulate antecubital vein with 18G/20G cannula. Power-inject 80-100ml non-ionic iodinated contrast at 3.0 ml/sec. Scan at 70s portal venous phase.',
                    'parameters' => [
                        ['parameterName' => 'Solid Abdominal Organs (Liver, Spleen, Kidneys)', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal parenchymal contrast enhancement', 'Benign liver hemangioma noted', 'Renal cortical cyst identified', 'Solid space-occupying lesion noted']],
                        ['parameterName' => 'Gastrointestinal Bowel Loops', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Uniform oral contrast opacification, normal wall thickness', 'Circumferential bowel wall thickening', 'Bowel caliber transition with obstruction']],
                        ['parameterName' => 'Retroperitoneal Vessels & Lymphatics', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Aorta and IVC patent with normal caliber', 'Aortic atherosclerotic plaque', 'Retroperitoneal lymphadenopathy']],
                        ['parameterName' => 'Free Peritoneal Fluid (Ascites)', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No free fluid in peritoneal cavity', 'Minimal fluid in pelvic pouch of Douglas', 'Moderate to severe ascites']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 7, 'quantityUsed' => 1], // Butterfly Needle
                        ['inventoryId' => 5, 'quantityUsed' => 1], // 20cc Syringe
                        ['inventoryId' => 9, 'quantityUsed' => 2],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 11. Pulmonology & Spirometry (ID: 12, human_based)
            // ========================================================
            'Pulmonology & Spirometry' => [
                [
                    'name' => 'Complete Spirometry (Pulmonary Function Test - PFT)',
                    'code' => 'PUL-001',
                    'price' => 2500,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 2,
                    'instructions' => 'Withhold short-acting bronchodilators for 6 hours. Refrain from smoking or heavy meals 2 hours before testing.',
                    'Instructions(SampleCollector)' => 'Apply nose clip firmly. Coach patient dynamically: full inspiration to TLC followed by explosive forced blast exhalation for minimum 6 seconds. Perform 3 acceptable and repeatable efforts.',
                    'parameters' => [
                        ['parameterName' => 'Forced Vital Capacity (FVC)', 'inputType' => 'Quantitative', 'unit' => 'L', 'normalRange' => '3.50 - 5.50', 'options' => null],
                        ['parameterName' => 'Forced Expiratory Volume 1s (FEV1)', 'inputType' => 'Quantitative', 'unit' => 'L', 'normalRange' => '3.00 - 4.50', 'options' => null],
                        ['parameterName' => 'FEV1 / FVC Ratio', 'inputType' => 'Quantitative', 'unit' => '%', 'normalRange' => '70.0 - 85.0', 'options' => null],
                        ['parameterName' => 'Peak Expiratory Flow Rate (PEFR)', 'inputType' => 'Quantitative', 'unit' => 'L/min', 'normalRange' => '400 - 650', 'options' => null],
                        ['parameterName' => 'Ventilatory Pattern Interpretation', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal Spirometric Parameters', 'Mild Obstructive Ventilatory Defect', 'Moderate Obstructive Defect', 'Restrictive Pattern (Requires Plethysmography)']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 17, 'quantityUsed' => 1],
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Bronchodilator Reversibility Assessment',
                    'code' => 'PUL-002',
                    'price' => 3500,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 2,
                    'instructions' => 'Do not take morning inhalers unless severe distress occurs. Rest quietly for 15 minutes before the initial test.',
                    'Instructions(SampleCollector)' => 'Record baseline pre-bronchodilator spirometry. Administer 400mcg Salbutamol via metered-dose inhaler with spacer. Re-test exactly 15 minutes later.',
                    'parameters' => [
                        ['parameterName' => 'Pre-Bronchodilator FEV1', 'inputType' => 'Quantitative', 'unit' => 'L', 'normalRange' => '2.50 - 4.50', 'options' => null],
                        ['parameterName' => 'Post-Bronchodilator FEV1', 'inputType' => 'Quantitative', 'unit' => 'L', 'normalRange' => '2.80 - 5.00', 'options' => null],
                        ['parameterName' => 'Absolute FEV1 Change', 'inputType' => 'Quantitative', 'unit' => 'mL', 'normalRange' => '0 - 200', 'options' => null],
                        ['parameterName' => 'Percentage FEV1 Improvement', 'inputType' => 'Quantitative', 'unit' => '%', 'normalRange' => '0.0 - 12.0', 'options' => null],
                        ['parameterName' => 'Airway Reversibility Response', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Significant Bronchodilator Reversibility (>12% and >200ml)', 'Negative / Non-significant Reversibility', 'Borderline Airway Response']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 17, 'quantityUsed' => 1],
                        ['inventoryId' => 9, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Fractional Exhaled Nitric Oxide (FeNO) Airway Inflammation Test',
                    'code' => 'PUL-003',
                    'price' => 3000,
                    'sampleType' => 'Exhaled Breath',
                    'resultHours' => 1,
                    'instructions' => 'Do not consume nitrate-rich foods (green leafy vegetables, cured meats) or caffeine for 2 hours before procedure.',
                    'Instructions(SampleCollector)' => 'Patient inhales fully through NO-scrubbing filter to total lung capacity, then exhales steadily against constant 12 cmH2O expiratory resistance for 10 seconds guided by visual biofeedback.',
                    'parameters' => [
                        ['parameterName' => 'Exhaled Nitric Oxide (FeNO Level)', 'inputType' => 'Quantitative', 'unit' => 'ppb', 'normalRange' => '5 - 25', 'options' => null],
                        ['parameterName' => 'Eosinophilic Airway Inflammation Level', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal / Low Eosinophilic Inflammation (<25 ppb)', 'Intermediate Inflammation (25-50 ppb)', 'High Eosinophilic Airway Inflammation (>50 ppb)']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 17, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
            ],

            // ========================================================
            // 12. Neurophysiology & EEG (ID: 13, human_based)
            // ========================================================
            'Neurophysiology & EEG' => [
                [
                    'name' => 'Digital Video-Electroencephalogram (32-Channel EEG)',
                    'code' => 'NEURO-001',
                    'price' => 4000,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 6,
                    'instructions' => 'Wash hair thoroughly with shampoo the night before; do not apply hair oil, grease, conditioner, or styling gel. Take regular anti-epileptic medications unless specifically directed by neurologist.',
                    'Instructions(SampleCollector)' => 'Measure scalp per 10-20 International Electrode System. Prep skin with abrasive paste. Secure 21 silver/gold disc electrodes with conductive paste (impedance < 5 kOhms). Perform 30-minute recording including 3-minute hyperventilation and intermittent photic stimulation.',
                    'parameters' => [
                        ['parameterName' => 'Background Alpha Rhythm Frequency', 'inputType' => 'Quantitative', 'unit' => 'Hz', 'normalRange' => '8.5 - 12.0', 'options' => null],
                        ['parameterName' => 'Interhemispheric Background Symmetry', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Symmetrical background rhythms', 'Asymmetrical amplitude suppression', 'Focal polymorphic delta slowing']],
                        ['parameterName' => 'Epileptiform Paroxysmal Activity', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['No epileptiform discharges identified', 'Generalized 3Hz spike-and-slow-wave complexes', 'Focal temporal sharp-and-slow-wave discharges', 'Frontal polyspike discharges']],
                        ['parameterName' => 'Intermittent Photic Driving Response', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal harmonic photic driving', 'Photoparoxysmal epileptiform response', 'Absent driving response']],
                        ['parameterName' => 'Overall Electroclinical Impression', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal adult awake and drowsy EEG', 'Abnormal EEG: Generalized epileptogenic tendency', 'Abnormal EEG: Focal seizure susceptibility', 'Abnormal EEG: Diffuse encephalopathic slowing']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 9, 'quantityUsed' => 4],
                        ['inventoryId' => 10, 'quantityUsed' => 2],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Nerve Conduction Velocity Studies (NCS - Upper & Lower Limbs)',
                    'code' => 'NEURO-002',
                    'price' => 5500,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 4,
                    'instructions' => 'Keep limbs and hands warm before the exam. Do not apply body lotions or moisturizers to hands, wrists, or feet.',
                    'Instructions(SampleCollector)' => 'Maintain skin temperature at >= 32°C. Place recording surface electrodes over target muscle and sensory nerve paths (Median, Ulnar, Peroneal, Tibial, Sural). Apply supramaximal electrical stimulation; record latency, amplitude, and conduction velocity.',
                    'parameters' => [
                        ['parameterName' => 'Median Motor Conduction Velocity', 'inputType' => 'Quantitative', 'unit' => 'm/s', 'normalRange' => '50.0 - 65.0', 'options' => null],
                        ['parameterName' => 'Ulnar Motor Conduction Velocity', 'inputType' => 'Quantitative', 'unit' => 'm/s', 'normalRange' => '50.0 - 65.0', 'options' => null],
                        ['parameterName' => 'Peroneal Motor Conduction Velocity', 'inputType' => 'Quantitative', 'unit' => 'm/s', 'normalRange' => '40.0 - 55.0', 'options' => null],
                        ['parameterName' => 'Tibial Motor Conduction Velocity', 'inputType' => 'Quantitative', 'unit' => 'm/s', 'normalRange' => '40.0 - 55.0', 'options' => null],
                        ['parameterName' => 'Sural Sensory Nerve Action Potential (SNAP)', 'inputType' => 'Quantitative', 'unit' => 'uV', 'normalRange' => '6.0 - 25.0', 'options' => null],
                        ['parameterName' => 'Diagnostic Electrophysiological Summary', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal peripheral motor and sensory conduction', 'Carpal Tunnel Syndrome (Median nerve focal entrapment)', 'Sensorimotor axonal polyneuropathy', 'Demyelinating peripheral neuropathy']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 9, 'quantityUsed' => 4],
                        ['inventoryId' => 11, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
                [
                    'name' => 'Concentric Needle Electromyography (EMG)',
                    'code' => 'NEURO-003',
                    'price' => 5000,
                    'sampleType' => 'Patient Procedure',
                    'resultHours' => 4,
                    'instructions' => 'Wear loose-fitting clothing. Disclose any bleeding tendencies or blood thinning medications before examination.',
                    'Instructions(SampleCollector)' => 'Swab skin over selected myotomes with alcohol. Insert sterile disposable concentric needle electrode into relaxed muscle. Examine insertional activity, spontaneous resting activity, and voluntary motor unit potentials during graded contraction.',
                    'parameters' => [
                        ['parameterName' => 'Spontaneous Resting Fibrillations / PSW', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['None (Electrically silent resting muscle)', '1+ Positive sharp waves and fibrillations', '2+ Active denervation potentials', 'Fasciculation potentials noted']],
                        ['parameterName' => 'Motor Unit Potential (MUAP) Amplitude', 'inputType' => 'Quantitative', 'unit' => 'uV', 'normalRange' => '500 - 2500', 'options' => null],
                        ['parameterName' => 'Motor Unit Potential (MUAP) Duration', 'inputType' => 'Quantitative', 'unit' => 'ms', 'normalRange' => '5.0 - 15.0', 'options' => null],
                        ['parameterName' => 'Interference Recruitment Pattern', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Full dense interference pattern', 'Reduced recruitment with high firing rate (Neurogenic)', 'Early recruitment of small units (Myopathic)']],
                        ['parameterName' => 'Myopathic vs Neurogenic Pattern', 'inputType' => 'Qualitative', 'unit' => null, 'normalRange' => null, 'options' => ['Normal electrodiagnostic muscle evaluation', 'Chronic neurogenic pattern (Cervical/Lumbosacral Radiculopathy)', 'Active denervation (Motor neuron / Axonal injury)', 'Myopathic pattern (Inflammatory myopathy)']],
                    ],
                    'requirements' => [
                        ['inventoryId' => 9, 'quantityUsed' => 3],
                        ['inventoryId' => 10, 'quantityUsed' => 1],
                        ['inventoryId' => 15, 'quantityUsed' => 1],
                    ],
                ],
            ],
        ];

        foreach ($departmentsTests as $deptName => $tests) {
            $department = Department::where('name', $deptName)->first();

            if (!$department) {
                // Fallback search in case of colon or slight punctuation difference
                $department = Department::where('name', 'like', trim($deptName, ':') . '%')
                    ->where('id', '!=', 1)
                    ->first();
            }

            if (!$department) {
                $this->command->warn("Department '{$deptName}' not found. Skipping.");
                continue;
            }

            foreach ($tests as $testData) {
                $test = Test::withTrashed()->updateOrCreate(
                    ['code' => $testData['code']],
                    [
                        'name' => $testData['name'],
                        'price' => $testData['price'],
                        'sampleType' => $testData['sampleType'],
                        'resultHours' => $testData['resultHours'],
                        'instructions' => $testData['instructions'],
                        'Instructions(SampleCollector)' => $testData['Instructions(SampleCollector)'],
                        'departmentId' => $department->id,
                        'userId' => $adminId,
                        'isActive' => true,
                        'deleted_at' => null,
                        'deleted_by' => null,
                    ]
                );

                // Re-sync Parameters (delete old, insert complete new parameters)
                TestParameter::where('testId', $test->id)->forceDelete();
                foreach ($testData['parameters'] as $param) {
                    TestParameter::create([
                        'testId' => $test->id,
                        'parameterName' => $param['parameterName'],
                        'inputType' => $param['inputType'],
                        'unit' => $param['unit'],
                        'normalRange' => $param['normalRange'],
                        'options' => $param['options'],
                    ]);
                }

                // Re-sync Requirements (delete old, insert complete new requirements)
                TestRequirement::where('testId', $test->id)->forceDelete();
                foreach ($testData['requirements'] as $req) {
                    TestRequirement::create([
                        'testId' => $test->id,
                        'inventoryId' => $req['inventoryId'],
                        'quantityUsed' => $req['quantityUsed'],
                    ]);
                }
            }
        }
    }
}

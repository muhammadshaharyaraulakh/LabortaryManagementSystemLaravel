<?php

namespace Database\Factories;

use App\Models\Inventory;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\InventoryLog;
use App\Models\User;

class InventoryFactory extends Factory
{
    protected static $index = 0;

    public function definition(): array
    {
        $items = [
            ['name' => '2cc Syringe', 'unit' => 'Pieces'],
            ['name' => '3cc Syringe', 'unit' => 'Pieces'],
            ['name' => '5cc Syringe', 'unit' => 'Pieces'],
            ['name' => '10cc Syringe', 'unit' => 'Pieces'],
            ['name' => '20cc Syringe', 'unit' => 'Pieces'],
            ['name' => 'Vacutainer Needle', 'unit' => 'Pieces'],
            ['name' => 'Butterfly Needle', 'unit' => 'Pieces'],
            ['name' => 'Tourniquet', 'unit' => 'Pieces'],
            ['name' => 'Alcohol Swabs', 'unit' => 'Box'],
            ['name' => 'Cotton Balls', 'unit' => 'Pack'],
            ['name' => 'Gauze Pads', 'unit' => 'Pack'],
            ['name' => 'Bandages', 'unit' => 'Box'],
            ['name' => 'Micropore Tape', 'unit' => 'Roll'],
            ['name' => 'Disposable Gloves Small', 'unit' => 'Box'],
            ['name' => 'Disposable Gloves Medium', 'unit' => 'Box'],
            ['name' => 'Disposable Gloves Large', 'unit' => 'Box'],
            ['name' => 'Face Masks', 'unit' => 'Box'],
            ['name' => 'Biohazard Bags', 'unit' => 'Pack'],
            ['name' => 'Sharps Container', 'unit' => 'Pieces'],
            ['name' => 'EDTA Tube (Purple)', 'unit' => 'Pieces'],
            ['name' => 'Gel Tube (Yellow)', 'unit' => 'Pieces'],
            ['name' => 'Plain Tube (Red)', 'unit' => 'Pieces'],
            ['name' => 'Fluoride Tube (Grey)', 'unit' => 'Pieces'],
            ['name' => 'Citrate Tube (Blue)', 'unit' => 'Pieces'],
            ['name' => 'Heparin Tube (Green)', 'unit' => 'Pieces'],
            ['name' => 'ESR Tube (Black)', 'unit' => 'Pieces'],
            ['name' => 'Capillary Tubes', 'unit' => 'Pack'],
            ['name' => 'Micro Collection Tubes', 'unit' => 'Pack'],
            ['name' => 'Urine Container', 'unit' => 'Pieces'],
            ['name' => 'Stool Container', 'unit' => 'Pieces'],
            ['name' => 'Sputum Container', 'unit' => 'Pieces'],
            ['name' => 'Blood Culture Bottle', 'unit' => 'Pieces'],
            ['name' => 'Glass Slides', 'unit' => 'Box'],
            ['name' => 'Cover Slips', 'unit' => 'Box'],
            ['name' => 'Slide Boxes', 'unit' => 'Pieces'],
            ['name' => 'Immersion Oil', 'unit' => 'Bottle'],
            ['name' => 'Staining Rack', 'unit' => 'Pieces'],
            ['name' => 'Leishman Stain', 'unit' => 'Bottle'],
            ['name' => 'Giemsa Stain', 'unit' => 'Bottle'],
            ['name' => 'Gram Stain Kit', 'unit' => 'Kit'],
            ['name' => 'Ziehl Neelsen Stain', 'unit' => 'Kit'],
            ['name' => 'CBC Reagent', 'unit' => 'ml'],
            ['name' => 'Hb Reagent', 'unit' => 'ml'],
            ['name' => 'ESR Reagent', 'unit' => 'ml'],
            ['name' => 'Glucose Reagent', 'unit' => 'ml'],
            ['name' => 'Urea Reagent', 'unit' => 'ml'],
            ['name' => 'Creatinine Reagent', 'unit' => 'ml'],
            ['name' => 'Cholesterol Reagent', 'unit' => 'ml'],
            ['name' => 'Triglycerides Reagent', 'unit' => 'ml'],
            ['name' => 'Bilirubin Reagent', 'unit' => 'ml'],
            ['name' => 'ALT Reagent', 'unit' => 'ml'],
            ['name' => 'AST Reagent', 'unit' => 'ml'],
            ['name' => 'ALP Reagent', 'unit' => 'ml'],
            ['name' => 'Uric Acid Reagent', 'unit' => 'ml'],
            ['name' => 'Total Protein Reagent', 'unit' => 'ml'],
            ['name' => 'Albumin Reagent', 'unit' => 'ml'],
            ['name' => 'Rapid Test Kits', 'unit' => 'Box'],
            ['name' => 'Pregnancy Test Kits', 'unit' => 'Box'],
            ['name' => 'Hepatitis B Test Kits', 'unit' => 'Box'],
            ['name' => 'Hepatitis C Test Kits', 'unit' => 'Box'],
            ['name' => 'HIV Test Kits', 'unit' => 'Box'],
            ['name' => 'Malaria Test Kits', 'unit' => 'Box'],
            ['name' => 'Typhoid Test Kits', 'unit' => 'Box'],
            ['name' => 'COVID Test Kits', 'unit' => 'Box'],
            ['name' => 'Distilled Water', 'unit' => 'Liter'],
            ['name' => 'Deionized Water', 'unit' => 'Liter'],
            ['name' => 'Cleaning Solution', 'unit' => 'Bottle'],
            ['name' => 'Disinfectant Solution', 'unit' => 'Bottle'],
            ['name' => 'Printer Paper', 'unit' => 'Ream'],
            ['name' => 'Barcode Labels', 'unit' => 'Roll'],
            ['name' => 'Lab Report Files', 'unit' => 'Pack'],
            ['name' => 'Sample Transport Bags', 'unit' => 'Pack']
        ];

        $item = $items[self::$index % count($items)];
        self::$index++;

        return [
            'name' => $item['name'],
            'unit' => $item['unit'],
            'current_stock' => $this->faker->numberBetween(50, 500),
            'alert' => $this->faker->numberBetween(10, 30),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Inventory $inventory) {
            if ($inventory->current_stock > 0) {
                InventoryLog::create([
                    'inventory_id' => $inventory->id,
                    'type' => 'In',
                    'quantity' => $inventory->current_stock,
                    'created_by' => User::inRandomOrder()->first()->id ?? null,
                    'action' => 'Initial Stock Added (System Seeder)'
                ]);
            }
        });
    }
}
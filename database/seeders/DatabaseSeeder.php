<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Department;
use App\Models\Inventory;
use App\Models\Test;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Department::firstOrCreate(['name' => 'Pathology'], ['type' => 'sample_based', 'is_active' => true]);
        Department::firstOrCreate(['name' => 'Radiology'], ['type' => 'human_based', 'is_active' => true]);
        $this->call(DepartmentSeeder::class);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::factory(10)->create();

        Inventory::factory(20)->create();

        $this->call(DepartmentTestsSeeder::class);
        
        Test::factory(14)->create();

        $this->call(OrderWorkflowSeeder::class);
    }
}
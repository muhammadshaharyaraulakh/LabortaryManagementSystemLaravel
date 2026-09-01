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
        Department::create(['name' => 'Pathology', 'type' => 'sample_based', 'is_active' => true]);
        Department::create(['name' => 'Radiology', 'type' => 'human_based', 'is_active' => true]);

        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
        ]);
        User::factory(10)->create();

        Inventory::factory(20)->create();
        
        Test::factory(14)->create();
    }
}
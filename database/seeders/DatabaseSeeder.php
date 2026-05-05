<?php

namespace Database\Seeders;

use Database\Factories\InventoryFactory;
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
        Test::factory(54)->create();
    }
}
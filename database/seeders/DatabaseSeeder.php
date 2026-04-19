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
        Department::factory(34)->create();
        User::create([
            'name' => 'Shaharyar',
            'email' => 'aulakhshaharyar@gmail.com',
            'password' => Hash::make('password'),
            'role' => 'Admin',
            'department_id' => null,
        ]);
        User::factory(5)->create();
        Inventory::factory(72)->create();
        Test::factory(44)->create();
    }
}
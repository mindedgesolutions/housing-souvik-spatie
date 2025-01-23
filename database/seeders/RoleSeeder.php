<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'anonymous user']);
        Role::create(['name' => 'authenticated user']);
        Role::create(['name' => 'administrator']);
        Role::create(['name' => 'applicant']);
        Role::create(['name' => 'occupant']);
        Role::create(['name' => 'housing official']);
        Role::create(['name' => 'sub-division']);
        Role::create(['name' => 'division']);
        Role::create(['name' => 'dealing assistant']);
        Role::create(['name' => 'housing supervisor']);
        Role::create(['name' => 'ddo']);
        Role::create(['name' => 'section officer']);
        Role::create(['name' => 'housing approver']);
        Role::create(['name' => 'sanctioning authority']);
        Role::create(['name' => 'executive engineer']);
        Role::create(['name' => 'rhe_work_assistant']);
    }
}

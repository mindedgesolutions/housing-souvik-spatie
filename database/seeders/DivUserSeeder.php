<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DivUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'kolnorthsubdiv2',
            'email' => 'kolnorthsubdiv2@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('sub-division');

        User::create([
            'name' => 'kolnorth1div',
            'email' => 'kolnorth1div@gmail.com',
            'password' => bcrypt('password'),
        ])->assignRole('division');
    }
}

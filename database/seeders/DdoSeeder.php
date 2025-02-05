<?php

namespace Database\Seeders;

use App\Models\HousingDdo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DdoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ddos = HousingDdo::select('ddo_code')->distinct()->get();

        foreach ($ddos as $ddo) {
            User::updateOrCreate(
                ['name' => $ddo->ddo_code],
                [
                    'name' => $ddo->ddo_code,
                    'email' => $ddo->ddo_code . '@gmail.com',
                    'password' => bcrypt('password'),
                ]
            )->assignRole('ddo');
        }
    }
}

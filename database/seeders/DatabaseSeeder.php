<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Role and user seeders are done ----------------

            // RoleSeeder::class,
            // UserSeeder::class,

            // Role and user seeders are done ----------------
            DdoSeeder::class,
        ]);
    }
}

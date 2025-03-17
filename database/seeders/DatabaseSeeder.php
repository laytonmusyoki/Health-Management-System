<?php

namespace Database\Seeders;

use App\Models\User;
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
            CountiesSeeder::class,
            PermissionSeeder::class,
            DrugsTableSeeder::class,
            MedicineDiseaseSeeder::class,
            SubCountiesSeeder::class,
            SuperAdminSeeder::class,
        ]);
    }
}

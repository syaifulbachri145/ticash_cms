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
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AccessTableSeeder::class);
        $this->call(TransactionCategorySeeder::class);
        $this->call(InstitutionTableSeeder::class);
        $this->call(DegreesTableSeeder::class);
    }
}
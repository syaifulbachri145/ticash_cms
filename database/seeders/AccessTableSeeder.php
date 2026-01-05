<?php

namespace Database\Seeders;

use App\Models\Access;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class AccessTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //create data user
        Access::create([
            'access_name'   => 'Administrator',
            'status'        => 'active',
            'disable'       => 'no',
        ]);
         Access::create([
            'access_name'   => 'Institution',
            'status'        => 'active',
            'disable'       => 'no',
        ]);
         Access::create([
            'access_name'   => 'Tenant',
            'status'        => 'active',
            'disable'       => 'no',
        ]);
        Access::create([
            'access_name'   => 'User',
            'status'        => 'active',
            'disable'       => 'no',
        ]);
        Access::create([
            'access_name'   => 'Student',
            'status'        => 'active',
            'disable'       => 'no',
        ]);
        Access::create([
            'access_name'   => 'Admin',
            'status'        => 'active',
            'disable'       => 'no',
        ]);
    }
}

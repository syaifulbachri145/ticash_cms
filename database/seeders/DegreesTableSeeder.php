<?php

namespace Database\Seeders;

use App\Models\Degree;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DegreesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Degree::create([
            'institution_id' => '1',
            'degree_name'  => 'ticash class',
            'status'       => 'non active',
            'disable'      => 'yes',
            
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Institution;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InstitutionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         Institution::create([
            'institution_code' => '1012025',
            'referral_code'    => '1012025',
            'institution_name' => 'ticash',
            'address'          => 'Grand Batavia Cluster Groove',
            'contact'          => '081285559758',
            'email'            => 'info@ticash.id',
            'balance'          => '0',
            'admin_fee'        => '3000',
            'shared_fee'       => '1000',
            'profit'           => '0',
            'invoice'          => '0',
            'status'           => 'active',
            'disable'          => 'no',
        ]);
    }
}

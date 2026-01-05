<?php

namespace Database\Seeders;

use App\Models\TransactionCategory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TransactionCategory::create([
            'coa_id'            => '301',
            'description'       => 'Topup',
            'is_hidden'         => 'yes',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '302',
            'description'       => 'Transfer',
            'is_hidden'         => 'yes', 
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '401',
            'description'       => 'Payment',
            'is_hidden'         => 'yes', 
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '303',
            'description'       => 'Withdrawal',
            'is_hidden'         => 'yes', 
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '304',
            'description'       => 'Claim',
            'is_hidden'         => 'yes', 
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '501',
            'description'       => 'Bill',
            'is_hidden'         => 'yes', 
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '111',
            'description'       => 'Topup',
            'is_hidden'         => 'yes', 
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '305',
            'description'       => 'Shop',
            'is_hidden'         => 'yes', 
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '112',
            'description'       => 'Gether',
            'is_hidden'         => 'yes',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '402',
            'description'       => 'Reedem',
            'is_hidden'         => 'yes',
            'status'            => 'active',
            'disable'           => 'no',
        ]);

         TransactionCategory::create([
            'coa_id'            => '306',
            'description'       => 'Saldo Awal',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);

         TransactionCategory::create([
            'coa_id'            => '403',
            'description'       => 'SPP',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '404',
            'description'       => 'Biaya Makan',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '405',
            'description'       => 'Seragam',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
        TransactionCategory::create([
            'coa_id'            => '406',
            'description'       => 'Buku',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
        TransactionCategory::create([
            'coa_id'            => '407',
            'description'       => 'Iuran',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
        TransactionCategory::create([
            'coa_id'            => '408',
            'description'       => 'Pendaftaran',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
        TransactionCategory::create([
            'coa_id'            => '409',
            'description'       => 'Bangunan',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '410',
            'description'       => 'Laundry',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
         TransactionCategory::create([
            'coa_id'            => '411',
            'description'       => 'Ekstrakulikuler',
            'is_hidden'         => 'no',
            'status'            => 'active',
            'disable'           => 'no',
        ]);
        
        
    }
}

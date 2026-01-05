<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        //permission for posts
        Permission::create(['name' => 'posts.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'posts.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'posts.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'posts.delete', 'guard_name' => 'web']);

        //permission for post_categories
        Permission::create(['name' => 'postCategories.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'postCategories.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'postCategories.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'postCategories.delete', 'guard_name' => 'web']);

        //permission for campaigns
        Permission::create(['name' => 'campaigns.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'campaigns.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'campaigns.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'campaigns.delete', 'guard_name' => 'web']);

        //permission for categories
        Permission::create(['name' => 'categories.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'categories.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'categories.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'categories.delete', 'guard_name' => 'web']);

        //permission for sliders
        Permission::create(['name' => 'sliders.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'sliders.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'sliders.delete', 'guard_name' => 'web']);

        //permission for roles
        Permission::create(['name' => 'roles.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.delete', 'guard_name' => 'web']);

        //permission for permissions
        Permission::create(['name' => 'permissions.index', 'guard_name' => 'web']);

        //permission for users
        Permission::create(['name' => 'users.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'users.delete', 'guard_name' => 'web']);

        //permission for institutions
        Permission::create(['name' => 'institutions.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'institutions.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'institutions.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'institutions.delete', 'guard_name' => 'web']);

        //permission for students
        Permission::create(['name' => 'students.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'students.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'students.delete', 'guard_name' => 'web']);

        //permission for merchants
        Permission::create(['name' => 'merchants.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'merchants.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'merchants.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'merchants.delete', 'guard_name' => 'web']);
//---------------------------------------------------------------------------------------
        //permission for finances
        Permission::create(['name' => 'finances.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'finances.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'finances.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'finances.delete', 'guard_name' => 'web']);

        //permission for balances
        Permission::create(['name' => 'balances.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'balances.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'balances.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'balances.delete', 'guard_name' => 'web']);

        //permission for withdrawals
        Permission::create(['name' => 'withdrawals.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'withdrawals.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'withdrawals.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'withdrawals.delete', 'guard_name' => 'web']);

        //permission for transactions
        Permission::create(['name' => 'transactions.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'transactions.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'transactions.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'transactions.delete', 'guard_name' => 'web']);

        //permission for transactionCategories
        Permission::create(['name' => 'transactionCategories.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'transactionCategories.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'transactionCategories.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'transactionCategories.delete', 'guard_name' => 'web']);

        //permission for payments
        Permission::create(['name' => 'payments.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'payments.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'payments.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'payments.delete', 'guard_name' => 'web']);

        //permission for paymentDetails
        Permission::create(['name' => 'paymentDetails.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'paymentDetails.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'paymentDetails.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'paymentDetails.delete', 'guard_name' => 'web']);

        //permission for paymentUsers
        Permission::create(['name' => 'paymentUsers.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'paymentUsers.show', 'guard_name' => 'web']);
        Permission::create(['name' => 'paymentUsers.edit', 'guard_name' => 'web']);

        //permission for Payment Categories
        Permission::create(['name' => 'paymentJournals.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'paymentJournals.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'paymentJournals.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'paymentJournals.delete', 'guard_name' => 'web']);

        //permission for savings
        Permission::create(['name' => 'savings.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'savings.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'savings.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'savings.delete', 'guard_name' => 'web']);

        //permission for gethers
        Permission::create(['name' => 'gethers.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'gethers.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'gethers.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'gethers.delete', 'guard_name' => 'web']);

        //permission for getherMembers
        Permission::create(['name' => 'getherMembers.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'getherMembers.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'getherMembers.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'getherMembers.delete', 'guard_name' => 'web']);

        //permission for claims
        Permission::create(['name' => 'claims.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'claims.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'claims.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'claims.delete', 'guard_name' => 'web']);

        //permission for topups
        Permission::create(['name' => 'topups.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'topups.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'topups.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'topups.delete', 'guard_name' => 'web']);

        //permission for histories
        Permission::create(['name' => 'histories.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'histories.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'histories.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'histories.delete', 'guard_name' => 'web']);

        //permission for shops
        Permission::create(['name' => 'shops.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'shops.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'shops.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'shops.delete', 'guard_name' => 'web']);

        //permission for transfers
        Permission::create(['name' => 'transfers.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'transfers.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'transfers.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'transfers.delete', 'guard_name' => 'web']);

        //permission for reedems
        Permission::create(['name' => 'reedems.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'reedems.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'reedems.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'reedems.delete', 'guard_name' => 'web']);

        //permission for Payment Categories
        Permission::create(['name' => 'degrees.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'degrees.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'degrees.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'degrees.delete', 'guard_name' => 'web']);

         //permission for bills
        Permission::create(['name' => 'bills.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'bills.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'bills.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'bills.delete', 'guard_name' => 'web']);


    }

}
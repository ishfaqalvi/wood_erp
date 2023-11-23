<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'banks-list',
            'banks-view',
            'banks-create',
            'banks-edit',
            'banks-delete',

            'shops-list',
            'shops-view',
            'shops-create',
            'shops-edit',
            'shops-delete',

            'purchaseItems-list',
            'purchaseItems-view',
            'purchaseItems-create',
            'purchaseItems-edit',
            'purchaseItems-delete',

            'purchaseStocks-list',
            'purchaseStocks-view',
            'purchaseStocks-create',
            'purchaseStocks-edit',
            'purchaseStocks-delete',

            'saleItems-list',
            'saleItems-view',
            'saleItems-create',
            'saleItems-edit',
            'saleItems-delete',

            'saleStocks-list',
            'saleStocks-view',
            'saleStocks-create',
            'saleStocks-edit',
            'saleStocks-delete',

            'vendors-list',
            'vendors-view',
            'vendors-create',
            'vendors-edit',
            'vendors-delete',

            'bills-list',
            'bills-view',
            'bills-create',
            'bills-edit',
            'bills-publish',
            'bills-delete',

            'purchasePayments-list',
            'purchasePayments-view',
            'purchasePayments-create',
            'purchasePayments-edit',
            'purchasePayments-approval',
            'purchasePayments-delete',

            'customers-list',
            'customers-view',
            'customers-create',
            'customers-edit',
            'customers-delete',

            'invoices-list',
            'invoices-view',
            'invoices-create',
            'invoices-edit',
            'invoices-publish',
            'invoices-delete',

            'salePayments-list',
            'salePayments-view',
            'salePayments-create',
            'salePayments-edit',
            'salePayments-approval',
            'salePayments-delete',

            'workers-list',
            'workers-view',
            'workers-create',
            'workers-edit',
            'workers-delete',

            'orders-list',
            'orders-view',
            'orders-create',
            'orders-edit',
            'orders-delete',

            'productionPayments-list',
            'productionPayments-view',
            'productionPayments-create',
            'productionPayments-edit',
            'productionPayments-approval',
            'productionPayments-delete',

            'accounts-list',
            'accounts-view',
            'accounts-create',
            'accounts-edit',
            'accounts-delete',

            'transfers-list',
            'transfers-view',
            'transfers-create',
            'transfers-edit',
            'transfers-delete',

            'transactions-list',
            'transactions-view',
            'transactions-create',
            'transactions-edit',
            'transactions-delete',

            'users-list',
            'users-view',
            'users-create',
            'users-edit',
            'users-delete',

            'roles-list',
            'roles-view',
            'roles-create',
            'roles-edit',
            'roles-delete',

            'notifications-list',
            'notifications-view',
            'notifications-create',
            'notifications-edit',
            'notifications-delete',

            'audits-list',
            'audits-view',
            'audits-create',
            'audits-edit',
            'audits-delete',

            'logs-list',
            'logs-view',
            'logs-create',
            'logs-edit',
            'logs-delete',

            'settings-list',
            'settings-create',
        ];
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}

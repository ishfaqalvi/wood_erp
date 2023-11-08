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
            'roles-list',
            'roles-view',
            'roles-create',
            'roles-edit',
            'roles-delete',

            'users-list',
            'users-view',
            'users-create',
            'users-edit',
            'users-delete',

            'purchaseItems-list',
            'purchaseItems-view',
            'purchaseItems-create',
            'purchaseItems-edit',
            'purchaseItems-delete',

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

            'banks-list',
            'banks-view',
            'banks-create',
            'banks-edit',
            'banks-delete',

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

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            'access_product',
            'acess_family',
            'access_category',
            'access_subcategory',








            'create',
            'edit',
            'show',
            'delete',
        ];
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }

        $adminrole = Role::create([
            'name' => 'Admin'
        ]);
    }
}



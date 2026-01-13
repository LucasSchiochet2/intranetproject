<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Permission;
use App\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Define modules/controllers
        $modules = [
            'news',
            'ombudsman',
            'documents',
            'document_categories',
            'calendar',
            'users',
            'roles',
            'permissions',
            'collaborators',
            'tasks',
            'dashboards',
            'banners',
            'tenants',
            'pages',
            'menu_items',
        ];

        // Create User Role
        $userRole = null;
        if (Role::where('name', 'user')->exists()) {
            $userRole = Role::findByName('user', 'web');
        } else {
            $userRole = Role::create(['name' => 'user', 'guard_name' => 'web']);
        }

        foreach ($modules as $module) {
            $listPermission = Permission::firstOrCreate(['name' => "list $module", 'guard_name' => 'web']);
            Permission::firstOrCreate(['name' => "create $module", 'guard_name' => 'web']);
            Permission::firstOrCreate(['name' => "update $module", 'guard_name' => 'web']);
            Permission::firstOrCreate(['name' => "delete $module", 'guard_name' => 'web']);

            $userRole->givePermissionTo($listPermission);
        }

        // Create Admin Role and assign all permissions
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $adminRole->givePermissionTo(Permission::all());
    }
}

<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use App\Models\Module;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CreatePermissionRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $date = Carbon::now()->format('Y-m-d H:i:s');
        $module = [
            ['name' => 'User', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Role', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Permission', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Entity', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Master', 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'Application', 'created_at' => $date, 'updated_at' => $date],
        ];

        $permission = [
            ['name' => 'create.user', 'guard_name' => 'web', 'module' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'edit.user', 'guard_name' => 'web', 'module' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'delete.user', 'guard_name' => 'web', 'module' => 1, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'view.user', 'guard_name' => 'web', 'module' => 1, 'created_at' => $date, 'updated_at' => $date],

            ['name' => 'create.role', 'guard_name' => 'web', 'module' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'edit.role', 'guard_name' => 'web', 'module' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'delete.role', 'guard_name' => 'web', 'module' => 2, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'view.role', 'guard_name' => 'web', 'module' => 2, 'created_at' => $date, 'updated_at' => $date],

            ['name' => 'create.permission', 'guard_name' => 'web', 'module' => 3, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'edit.permission', 'guard_name' => 'web', 'module' => 3, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'delete.permission', 'guard_name' => 'web', 'module' => 3, 'created_at' => $date, 'updated_at' => $date],
            ['name' => 'view.permission', 'guard_name' => 'web', 'module' => 3, 'created_at' => $date, 'updated_at' => $date],
        ];
        Module::insert($module);
        Permission::insert($permission);
        $role = Role::create(
            ['guard_name' => 'web', 'name' => 'Admin']
        );
        $role->givePermissionTo(Permission::all());

        $role1 = Role::insert([
            ['guard_name' => 'web', 'name' => 'Super Admin'],
            ['guard_name' => 'web', 'name' => 'Entity'],
            ['guard_name' => 'web', 'name' => 'Data Entry'],

        ]);

    }
}

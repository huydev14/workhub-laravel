<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permissions seeder
        $permissions = [
            'users.view',
            'users.create',
            'users.edit',
            'users.delete',
        ];

        // Create permissions
        foreach ($permissions as $permission) {
            Permission::firstOrCreate([
                'name' => $permission,
                'guard_name' => 'api',
            ]);
        }

        // Roles seeder
        $roleSeeder =
            Role::firstOrCreate(
                [
                    'name' => 'Super Admin',
                    'description' => 'Toàn quyền truy cập và kiểm soát mọi tính năng.',
                    'guard_name' => 'api',
                ],
                [
                    'name' => 'Manager',
                    'description' => 'Quản lý nhân sự và truy cập các tính năng thống kê báo cáo.',
                    'guard_name' => 'api',
                ],
                [
                    'name' => 'Employee',
                    'description' => 'Nhân viên được phép truy cập các tính năng cơ bản.',
                    'guard_name' => 'api',
                ],
            );

        $roleSeeder->syncPermissions(Permission::all());

        // Assign role to user id 1 (Super Admin)
        $user = User::find(1);
        if ($user) {
            $user->syncRoles(['Super Admin']);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // مجوزها
        $permissions = [
            'access admin panel',
            'edit tree',
            'report tree',
        ];
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission]);
        }

        // نقش‌ها
        $admin = Role::firstOrCreate(['name' => 'admin']);
        $employee = Role::firstOrCreate(['name' => 'employee']);
        $citizen = Role::firstOrCreate(['name' => 'citizen']);

        // تخصیص مجوزها به نقش‌ها
        $admin->givePermissionTo(['access admin panel', 'edit tree', 'report tree']);
        $employee->givePermissionTo(['edit tree', 'report tree']);
        $citizen->givePermissionTo(['report tree']);
    }
}

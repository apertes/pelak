<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // ساخت سوپرادمین اگر وجود نداشت
        $superadmin = \App\Models\User::where('email', 'ahmad.mohamadpour.gh@gmail.com')->first();
        if (!$superadmin) {
            $superadmin = \App\Models\User::create([
                'name' => 'احمد محمدپور',
                'email' => 'ahmad.mohamadpour.gh@gmail.com',
                'password' => bcrypt('123456789'),
                'phone' => '09902621572',
                'national_code' => '2080130481',
                'type' => 'employee',
            ]);
        }
        $superadmin->assignRole('admin');
        $superadmin->givePermissionTo(\Spatie\Permission\Models\Permission::all());

        // اجرای seeder نقش‌ها و مجوزها
        $this->call(RolesAndPermissionsSeeder::class);
        // تبدیل پست‌های موجود به نقش‌ها
        $this->call(ConvertPostsToRolesSeeder::class);
    }
}

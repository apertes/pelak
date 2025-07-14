<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use App\Observers\UserPostSyncRoleObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // سوپرادمین همیشه وجود داشته باشد
        $email = 'ahmad.mohamadpour.gh@gmail.com';
        $superadmin = User::where('email', $email)->first();
        if (!$superadmin) {
            $superadmin = User::create([
                'name' => 'احمد محمدپور',
                'email' => $email,
                'password' => Hash::make('123456789'),
                'phone' => '09902621572',
                'national_code' => '2080130481',
                'type' => 'employee',
            ]);
        }
        // اطمینان از داشتن نقش و مجوز کامل
        if (!$superadmin->hasRole('admin')) {
            $superadmin->assignRole('admin');
        }
        $allPermissions = Permission::all();
        $superadmin->givePermissionTo($allPermissions);
        \App\Models\User::observe(UserPostSyncRoleObserver::class);
    }
}

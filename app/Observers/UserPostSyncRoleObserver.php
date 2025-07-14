<?php

namespace App\Observers;

use App\Models\User;
use Spatie\Permission\Models\Role;

class UserPostSyncRoleObserver
{
    /**
     * Handle the User "saved" event.
     */
    public function saved(User $user): void
    {
        $this->syncPostRoles($user);
    }

    /**
     * همگام‌سازی نقش‌های متناظر پست‌های کاربر
     */
    public function syncPostRoles(User $user)
    {
        // دریافت نام پست‌های کاربر
        $postTitles = $user->posts()->pluck('title')->toArray();
        // دریافت نقش‌های پستی
        $postRoles = Role::whereIn('name', $postTitles)->where('is_post_role', true)->pluck('name')->toArray();
        // نقش‌های فعلی کاربر (به جز admin و نقش‌های سفارشی)
        $customRoles = $user->roles()->where('is_post_role', false)->pluck('name')->toArray();
        if ($user->hasRole('admin')) {
            $customRoles[] = 'admin';
        }
        // sync فقط نقش‌های پستی و سفارشی (admin حذف نشود)
        $user->syncRoles(array_merge($postRoles, $customRoles));
    }
}

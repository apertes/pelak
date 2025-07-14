<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use Spatie\Permission\Models\Role;

class ConvertPostsToRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            // اگر نقش با این نام وجود ندارد، بساز
            if (!Role::where('name', $post->title)->where('is_post_role', true)->exists()) {
                Role::create([
                    'name' => $post->title,
                    'is_post_role' => true,
                    'guard_name' => 'web',
                ]);
                $this->command->info("نقش '{$post->title}' ساخته شد.");
            } else {
                $this->command->info("نقش '{$post->title}' قبلاً وجود دارد.");
            }
        }
        $this->command->info('تبدیل پست‌ها به نقش‌ها با موفقیت انجام شد.');
    }
}

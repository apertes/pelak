<?php

namespace App\Http\Controllers\Admin\UserManagement;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;

class UserPostController extends Controller
{
    // نمایش فرم انتخاب سمت‌های کاربر
    public function edit($user_id)
    {
        $user = User::findOrFail($user_id);
        $posts = Post::all();
        return view('admin-panel.users.posts', compact('user', 'posts'));
    }

    // ذخیره سمت‌های انتخاب‌شده برای کاربر
    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        $validated = $request->validate([
            'posts' => 'array',
            'posts.*' => 'exists:posts,id',
        ]);
        $user->posts()->sync($request->input('posts', []));
        return redirect()->route('admin.users.index')->with('success', 'سمت‌های کاربر با موفقیت به‌روزرسانی شد.');
    }
} 
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('parent')->paginate(15);
        return view('admin-panel.posts.index', compact('posts'));
    }

    public function create()
    {
        $parents = Post::all();
        return view('admin-panel.posts.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:posts,id',
        ]);
        Post::create($validated);
        return redirect()->route('admin.posts.index')->with('success', 'سمت با موفقیت ایجاد شد.');
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $parents = Post::where('id', '!=', $id)->get();
        return view('admin-panel.posts.edit', compact('post', 'parents'));
    }

    public function update(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:posts,id',
        ]);
        $post->update($validated);
        return redirect()->route('admin.posts.index')->with('success', 'سمت با موفقیت ویرایش شد.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return redirect()->route('admin.posts.index')->with('success', 'سمت حذف شد.');
    }
} 
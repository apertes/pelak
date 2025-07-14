<?php

namespace App\Livewire\PostManager;

use Livewire\Component;
use App\Models\Post;
use Spatie\Permission\Models\Role;

class PostManager extends Component
{
    public $posts;
    public $title;
    public $description;
    public $parent_id;
    public $post_id = null;
    public $parents;
    public $editMode = false;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'parent_id' => 'nullable|exists:posts,id',
    ];

    public function mount()
    {
        $this->fetchPosts();
        $this->parents = Post::all();
    }

    public function fetchPosts()
    {
        $this->posts = Post::with('parent')->orderByDesc('id')->get();
    }

    public function resetForm()
    {
        $this->title = '';
        $this->description = '';
        $this->parent_id = null;
        $this->post_id = null;
        $this->editMode = false;
    }

    public function store()
    {
        $this->validate();
        $post = Post::create([
            'title' => $this->title,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
        ]);
        // ایجاد نقش مرتبط با پست اگر وجود ندارد
        if (!Role::where('name', $post->title)->where('is_post_role', true)->exists()) {
            Role::create([
                'name' => $post->title,
                'is_post_role' => true,
                'guard_name' => 'web',
            ]);
        }
        $this->resetForm();
        $this->fetchPosts();
        $this->dispatch('swal', ['type' => 'success', 'message' => 'سمت با موفقیت ایجاد شد.']);
    }

    public function edit($id)
    {
        $post = Post::findOrFail($id);
        $this->post_id = $post->id;
        $this->title = $post->title;
        $this->description = $post->description;
        $this->parent_id = $post->parent_id;
        $this->editMode = true;
    }

    public function update()
    {
        $this->validate();
        $post = Post::findOrFail($this->post_id);
        $post->update([
            'title' => $this->title,
            'description' => $this->description,
            'parent_id' => $this->parent_id,
        ]);
        $this->resetForm();
        $this->fetchPosts();
        $this->dispatch('swal', ['type' => 'success', 'message' => 'سمت با موفقیت ویرایش شد.']);
    }

    public function confirmDelete($id)
    {
        $this->dispatch('confirm-delete', ['id' => $id]);
    }

    public function delete($id)
    {
        Post::findOrFail($id)->delete();
        $this->fetchPosts();
        $this->dispatch('swal', ['type' => 'success', 'message' => 'سمت حذف شد.']);
    }

    public function render()
    {
        return view('livewire.post-manager.post-manager');
    }
}

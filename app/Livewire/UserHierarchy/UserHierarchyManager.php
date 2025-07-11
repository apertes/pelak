<?php

namespace App\Livewire\UserHierarchy;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;
use Illuminate\Support\Collection;

class UserHierarchyManager extends Component
{
    public $users;
    public $posts;
    public $selectedUser = '';
    public $parentUsers;
    public $childUsers;
    public $newParents = [];
    public $newChildren = [];
    public $userPosts;
    public $newPosts = [];

    public function mount()
    {
        $this->users = User::with('posts')->get();
        $this->posts = Post::all();
        $this->parentUsers = collect();
        $this->childUsers = collect();
        $this->userPosts = collect();
    }

    public function testMethod()
    {
        \Log::info('Test method called');
        session()->flash('message', 'Livewire is working! Test method called at: ' . now());
    }

    public function updatedSelectedUser()
    {
        \Log::info('updatedSelectedUser called', ['selectedUser' => $this->selectedUser]);
        
        $user = $this->getSelectedUserModel();
        \Log::info('User found', ['user' => $user ? $user->name : 'null']);
        
        $this->parentUsers = $user ? $user->parents()->with('posts')->get() : collect();
        $this->childUsers = $user ? $user->childrenHierarchy()->with('posts')->get() : collect();
        $this->userPosts = $user ? $user->posts()->get() : collect();
        $this->newParents = [];
        $this->newChildren = [];
        $this->newPosts = [];
        
        \Log::info('Data loaded', [
            'parentUsers' => $this->parentUsers->count(),
            'childUsers' => $this->childUsers->count(),
            'userPosts' => $this->userPosts->count()
        ]);
    }

    public function addParents()
    {
        $user = $this->getSelectedUserModel();
        if (!$user) return;
        $ids = array_map('intval', $this->newParents);
        // اعتبارسنجی حلقه و سمت‌ها
        foreach ($ids as $parentId) {
            if ($parentId == $user->id || $user->parents->contains($parentId)) continue;
            $parent = $this->users->find($parentId);
            if ($parent) {
                // سمت والد باید بالاتر باشد
                $valid = false;
                foreach ($parent->posts as $parentPost) {
                    foreach ($user->posts as $childPost) {
                        $current = $childPost;
                        while ($current) {
                            if ($current->parent_id == $parentPost->id) {
                                $valid = true;
                                break 2;
                            }
                            $current = $current->parent;
                        }
                    }
                }
                if ($valid) {
                    $user->parents()->attach($parentId);
                }
            }
        }
        $this->updatedSelectedUser();
    }

    public function removeParent($parentId)
    {
        $user = $this->getSelectedUserModel();
        if ($user) {
            $user->parents()->detach($parentId);
            $this->updatedSelectedUser();
        }
    }

    public function addChildren()
    {
        $user = $this->getSelectedUserModel();
        if (!$user) return;
        $ids = array_map('intval', $this->newChildren);
        foreach ($ids as $childId) {
            if ($childId == $user->id || $user->childrenHierarchy->contains($childId)) continue;
            $child = $this->users->find($childId);
            if ($child) {
                // سمت کاربر باید بالاتر از سمت زیرمجموعه باشد
                $valid = false;
                foreach ($user->posts as $parentPost) {
                    foreach ($child->posts as $childPost) {
                        $current = $childPost;
                        while ($current) {
                            if ($current->parent_id == $parentPost->id) {
                                $valid = true;
                                break 2;
                            }
                            $current = $current->parent;
                        }
                    }
                }
                if ($valid) {
                    $user->childrenHierarchy()->attach($childId);
                }
            }
        }
        $this->updatedSelectedUser();
    }

    public function removeChild($childId)
    {
        $user = $this->getSelectedUserModel();
        if ($user) {
            $user->childrenHierarchy()->detach($childId);
            $this->updatedSelectedUser();
        }
    }

    public function addPosts()
    {
        $user = $this->getSelectedUserModel();
        if (!$user) return;
        $ids = array_map('intval', $this->newPosts);
        foreach ($ids as $postId) {
            if (!$user->posts->contains($postId)) {
                $user->posts()->attach($postId);
            }
        }
        $this->updatedSelectedUser();
    }

    public function removePost($postId)
    {
        $user = $this->getSelectedUserModel();
        if ($user) {
            $user->posts()->detach($postId);
            $this->updatedSelectedUser();
        }
    }

    private function getSelectedUserModel()
    {
        return $this->users->find($this->selectedUser);
    }

    public function render()
    {
        return view('livewire.user-hierarchy.user-hierarchy-manager');
    }
}

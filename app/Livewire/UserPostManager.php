<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;

class UserPostManager extends Component
{
    public $users;
    public $posts;
    public $selectedUser = '';
    public $userPosts;
    public $newPosts = [];

    public function mount()
    {
        $this->users = User::all();
        $this->posts = Post::all();
        $this->userPosts = collect();
    }

    public function updatedSelectedUser()
    {
        $user = $this->getSelectedUserModel();
        $this->userPosts = $user ? $user->posts()->get() : collect();
        $this->newPosts = [];
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
        return view('livewire.user-post-manager');
    }
} 
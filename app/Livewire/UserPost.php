<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Post;

class UserPost extends Component
{
    public $users;
    public $posts;
    public $selectedUser = '';
    public $userPosts;
    public $newPosts = [];
    public $userPostAssignments;

    public function mount()
    {
        $this->users = User::all();
        $this->posts = Post::all();
        $this->userPosts = collect();
        $this->userPostAssignments = collect();
        $this->loadUserPostAssignments();
    }

    public function loadUserPostAssignments()
    {
        $this->userPostAssignments = \DB::table('user_post')
            ->join('users', 'user_post.user_id', '=', 'users.id')
            ->join('posts', 'user_post.post_id', '=', 'posts.id')
            ->select('user_post.id', 'users.name as user_name', 'posts.title as post_title', 'user_post.user_id', 'user_post.post_id')
            ->orderBy('users.name')
            ->orderBy('posts.title')
            ->get();
    }

    public function updatedSelectedUser()
    {
        $user = $this->getSelectedUserModel();
        $this->userPosts = $user ? $user->posts()->get() : collect();
        $this->newPosts = [];
    }

    public function addPosts()
    {
        // Debug: بررسی مقدار selectedUser
        if (!$this->selectedUser) {
            session()->flash('message', 'هیچ کاربری انتخاب نشده است!');
            return;
        }

        $user = $this->getSelectedUserModel();
        if (!$user) {
            session()->flash('message', 'کاربر پیدا نشد!');
            return;
        }

        // Debug: بررسی مقدار newPosts
        if (empty($this->newPosts)) {
            session()->flash('message', 'هیچ پستی انتخاب نشده است!');
            return;
        }

        $ids = array_map('intval', $this->newPosts);
        
        // Debug: نمایش تعداد پست‌های انتخاب شده
        session()->flash('message', count($ids) . ' پست انتخاب شده است.');
        
        foreach ($ids as $postId) {
            if (!$user->posts->contains($postId)) {
                $user->posts()->attach($postId);
            }
        }
        
        $this->updatedSelectedUser();
        $this->loadUserPostAssignments();
        
        session()->flash('message', 'پست‌ها با موفقیت اضافه شدند!');
    }

    public function removePost($postId)
    {
        $user = $this->getSelectedUserModel();
        if ($user) {
            $user->posts()->detach($postId);
            $this->updatedSelectedUser();
            $this->loadUserPostAssignments();
        }
    }

    public function removeAssignment($userId, $postId)
    {
        \DB::table('user_post')->where('user_id', $userId)->where('post_id', $postId)->delete();
        $this->updatedSelectedUser();
        $this->loadUserPostAssignments();
    }

    private function getSelectedUserModel()
    {
        return $this->users->find($this->selectedUser);
    }

    public function render()
    {
        return view('livewire.user-post', [
            'userPostAssignments' => $this->userPostAssignments,
        ]);
    }
}

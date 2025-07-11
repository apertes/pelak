<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;

class UserPostTree extends Component
{
    public $treeData = [];

    public function mount()
    {
        $this->loadTreeData();
    }

    public function loadTreeData()
    {
        try {
            $posts = Post::with(['users' => function($q){ 
                $q->with('childrenHierarchy'); 
            }])->whereNull('parent_id')->get();
            
            $this->treeData = $this->makeTree($posts);
        } catch (\Exception $e) {
            session()->flash('error', 'خطا در بارگذاری داده‌ها: ' . $e->getMessage());
        }
    }

    private function makeTree($posts)
    {
        return $posts->map(function($post) {
            return [
                'label' => $post->title,
                'type' => 'post',
                'children' => $post->users->map(function($user) {
                    return [
                        'label' => $user->name,
                        'type' => 'user',
                        'children' => $user->childrenHierarchy->map(function($child) {
                            return [
                                'label' => $child->name,
                                'type' => 'user',
                                'children' => []
                            ];
                        })->toArray()
                    ];
                })->toArray(),
            ];
        })->toArray();
    }

    public function render()
    {
        return view('livewire.user-post-tree');
    }
}

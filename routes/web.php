<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlantedTree\PlantedTreeController;

Route::get('/', function () {
    return view('welcome');
});

require __DIR__.'/admin.php';

Route::get('admin/tree-groups', function() {
    return view('admin-panel.tree-groups');
})->name('admin.tree-groups');
Route::get('admin/trees', function() {
    return view('admin-panel.trees');
})->name('admin.trees');

// صفحه ایندکس Livewire
Route::get('admin/planted-trees', function() {
    return view('admin-panel.planted-trees');
})->name('admin.planted-trees');

// resource controller برای create, store, edit, update, show
Route::resource('admin/planted-trees', PlantedTreeController::class)->except(['index', 'destroy']);

Route::get('/admin/api/user-post-tree', function () {
    try {
        $posts = \App\Models\Post::with(['users' => function($q){ 
            $q->with('childrenHierarchy'); 
        }])->whereNull('parent_id')->get();
        
        \Log::info('Posts found:', ['count' => $posts->count()]);
        
        $makeTree = function($posts) use (&$makeTree) {
            return $posts->map(function($post) use (&$makeTree) {
                \Log::info('Processing post:', ['title' => $post->title, 'users_count' => $post->users->count()]);
                
                return [
                    'label' => $post->title,
                    'children' => $post->users->map(function($user) {
                        \Log::info('Processing user:', ['name' => $user->name, 'children_count' => $user->childrenHierarchy->count()]);
                        
                        return [
                            'label' => $user->name,
                            'children' => $user->childrenHierarchy->map(function($child) {
                                return [
                                    'label' => $child->name,
                                    'children' => [] // فقط یک سطح برای نمونه
                                ];
                            })->toArray()
                        ];
                    })->toArray(),
                ];
            })->toArray();
        };
        
        $result = $makeTree($posts);
        \Log::info('Final tree result:', $result);
        
        return response()->json($result);
    } catch (\Exception $e) {
        \Log::error('Error in user-post-tree API:', ['error' => $e->getMessage()]);
        return response()->json(['error' => $e->getMessage()], 500);
    }
});

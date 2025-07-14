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

// نمایش عمومی اطلاعات درخت بر اساس ID (بدون prefix admin)
Route::get('/tree/{id}', [PlantedTreeController::class, 'publicShow'])->name('tree.public.show');
Route::post('/tree/{id}/create', [PlantedTreeController::class, 'storeFromQr'])->name('tree.public.create');

// اضافه کردن روت ویرایش عمومی برای درختان کاشته شده
Route::get('/planted-trees/{planted_tree}/edit', [PlantedTreeController::class, 'edit'])->name('planted-trees.edit');

// گزارشات درخت
Route::post('planted-trees/{planted_tree}/report', [\App\Http\Controllers\TreeReportController::class, 'store'])->name('planted-trees.report.store');
Route::get('planted-trees/{planted_tree}/reports', [\App\Http\Controllers\TreeReportController::class, 'index'])->name('planted-trees.reports.index');
Route::get('tree-reports/{report}', [\App\Http\Controllers\TreeReportController::class, 'show'])->name('tree-reports.show');

// لیست همه گزارشات برای ادمین
Route::get('admin/tree-reports', [\App\Http\Controllers\TreeReportController::class, 'adminIndex'])->name('admin.tree-reports.index');

// Admin Auth Routes
Route::get('login', function () {
    return redirect()->route('admin.login');
})->name('login');
Route::post('login', [\App\Http\Controllers\Admin\Auth\LoginController::class, 'login']);
Route::get('dashboard', function() {
    return view('admin-panel.dashboard');
})->middleware('auth')->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('roles', \App\Http\Controllers\Admin\Permission\RoleController::class);
    Route::resource('permissions', \App\Http\Controllers\Admin\Permission\PermissionController::class);
    Route::resource('user-roles', \App\Http\Controllers\Admin\Permission\UserRoleController::class)
        ->parameters(['user-roles' => 'user']);
});

// فرم لاگین و ثبت‌نام شهروندان
Route::get('/user/login', function () {
    return view('user.login');
})->name('user.login');
Route::post('/user/login', [App\Http\Controllers\UserAuthController::class, 'login'])->name('user.login.submit');
Route::post('/user/register', [App\Http\Controllers\UserAuthController::class, 'register'])->name('user.register.submit');

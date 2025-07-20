<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserManagement\UserController;
use App\Http\Middleware\EmployeeMiddleware;
use App\Http\Controllers\Admin\AdminAuthController;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::prefix('admin')->name('admin.')->middleware(['auth', EmployeeMiddleware::class])->group(function () {
    Route::get('/', [\App\Http\Controllers\Admin\Dashboard\DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class);
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class);
    Route::get('users/{user}/posts', [\App\Http\Controllers\Admin\UserManagement\UserPostController::class, 'edit'])->name('users.posts.edit');
    Route::put('users/{user}/posts', [\App\Http\Controllers\Admin\UserManagement\UserPostController::class, 'update'])->name('users.posts.update');
    Route::get('user-hierarchy/manage', function () {
        return view('admin-panel.users.hierarchy.manage');
    })->name('user-hierarchy.manage');
    Route::get('user-posts', function () {
        return view('admin-panel.user-posts.index');
    })->name('user-posts.index');
    Route::get('user-posts/tree', function () {
        return view('admin-panel.user-posts.tree-livewire');
    })->name('user-posts.tree');
    Route::get('user-posts/graph', function () {
        return view('admin-panel.user-posts.graph');
    })->name('user-posts.graph');
    Route::get('locations/manage', function () {
        return view('admin-panel.locations.manage');
    })->name('locations.manage');

    Route::get('positions/manage', function () {
        return view('admin-panel.positions.manage');
    })->name('positions.manage');

    Route::get('regions', function () {
        return view('admin-panel.regions');
    })->name('regions');

    // QR Code Generator Routes
    Route::get('qr-generator', [\App\Http\Controllers\Admin\QrCodeGenerator\QrCodeGeneratorController::class, 'index'])->name('qr-generator.index');
    Route::post('qr-generator/generate', [\App\Http\Controllers\Admin\QrCodeGenerator\QrCodeGeneratorController::class, 'generate'])->name('qr-generator.generate');
}); 
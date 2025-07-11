<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserManagement\UserController;

Route::prefix('admin')->name('admin.')->group(function () {
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
}); 
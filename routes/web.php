<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\front\HomeController;
use App\Http\Controllers\admin\HomeController as AdminHomeController;
use App\Http\Controllers\admin\AuthController as AdminAuthController;
use App\Http\Controllers\admin\RolePermissionController;

Route::get('/', [HomeController::class, 'index'])->name('/');

Route::prefix('admin')->group(function() {
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'loginProcess'])->name('admin.login');
    Route::middleware('auth')->group(function() {
        Route::get('/', [AdminHomeController::class, 'index'])->name('admin.dashboard');

        //roles
        Route::get('/roles', [RolePermissionController::class, 'roles'])->name('admin.roles.index');
        Route::get('/roles/create', [RolePermissionController::class, 'createRole'])->name('admin.roles.create');
        Route::post('/roles', [RolePermissionController::class, 'storeRole'])->name('admin.roles.store');
        Route::get('/roles/{role}/edit', [RolePermissionController::class, 'editRole'])->name('admin.roles.edit');
        Route::put('/roles/{id}', [RolePermissionController::class, 'updateRole'])->name('admin.roles.update');
        Route::delete('/delete_role/{id}', [RolePermissionController::class, 'deleteRole'])->name('admin.roles.delete');

        //permissions
        Route::get('/permissions', [RolePermissionController::class, 'permissions'])->name('admin.permissions.index');
        Route::post('/permissions', [RolePermissionController::class, 'createPermission'])->name('admin.permission.store');
        Route::put('/permissions/{id}', [RolePermissionController::class, 'updatePermission'])->name('admin.permission.update');
        Route::delete('permission/{id}', [RolePermissionController::class, 'deletePermission'])->name('admin.permission.delete');

        Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
});

<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RolePermissionController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', 'cms/admin/login', 301);
Route::prefix('cms/')->middleware('guest:admin')->group(function () {
    Route::get('{guard}/login', [AuthController::class, 'showLogin'])->name('auth.login');
    Route::post('login', [AuthController::class, 'login']);
});


Route::prefix('cms/admin')->middleware('auth:admin,publisher')->group(function () {
    Route::view('/dashboard', 'cms.parant')->name('dashboard');
    Route::resource('book', BookController::class);
    Route::resource('departments', DepartmentController::class);


    Route::get('logout', [AuthController::class, 'logout'])->name('auth.logout');

    Route::get('edit-profile', [AuthController::class, 'editProfile'])->name('auth.editProfile');
    Route::put('update-profile', [AuthController::class, 'updateProfile']);

    Route::get('change-password', [AuthController::class, 'changePassword'])->name('auth.changePassword');
    Route::put('update-password', [AuthController::class, 'updatePassword']);
});


Route::prefix('cms/admin')->middleware('auth:admin')->group(function () {

    Route::resource('admins', AdminController::class);

    // Role & Permission'
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    // Route::resource('permissions/role', RolePermissionController::class);
    Route::post('role/{role}/permissions', [RolePermissionController::class, 'store']);
});

Route::middleware('age:13')->group(function () {
    Route::get('news', function () {
        echo 'WE ARE ABLE TO VIEW THE NEWS , AGE >=180 ';
    });

    Route::get('news2', function () {
        echo 'WE ARE ABLE TO VIEW THE NEWS 2 , AGE >=180 ';
    })->withoutMiddleware('age');
});

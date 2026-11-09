<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

Route::get('admin/login', [AuthController::class, 'login_view'])->name('admin.login');
Route::post('admin/login', [AuthController::class, 'login']);
Route::get('admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

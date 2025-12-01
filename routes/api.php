<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// =======================
//   Import Controllers
// =======================
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\DesignController;
use App\Http\Controllers\Admin\ProgressApprovalController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\AdminProjectController;

// ==========================================
//   Group khusus ADMIN (prefix: /api/admin)
// ==========================================
Route::prefix('admin')->group(function () {

    // ============================
    //       CRUD USERS (ADMIN)
    // ============================
    Route::get('/users',              [UserManagementController::class, 'index']);
    Route::post('/users',             [UserManagementController::class, 'store']);
    Route::get('/users/{id}',         [UserManagementController::class, 'show']);
    Route::put('/users/{id}',         [UserManagementController::class, 'update']);
    Route::delete('/users/{id}',      [UserManagementController::class, 'destroy']);

    // ============================
    //       CRUD DESIGNS (ADMIN)
    // ============================
    Route::get('/designs',            [DesignController::class, 'index']);
    Route::post('/designs',           [DesignController::class, 'store']);
    Route::get('/designs/{id}',       [DesignController::class, 'show']);
    Route::put('/designs/{id}',       [DesignController::class, 'update']);
    Route::delete('/designs/{id}',    [DesignController::class, 'destroy']);

    // ====================================
    //    APPROVE / REJECT PROGRESS (ADMIN)
    // ====================================
    Route::get('/progress/pending',           [ProgressApprovalController::class, 'pending']);
    Route::post('/progress/{id}/approve',     [ProgressApprovalController::class, 'approve']);
    Route::post('/progress/{id}/reject',      [ProgressApprovalController::class, 'reject']);
});


Route::prefix('superadmin')->group(function () {
    // ====================================
    //    CRUD USER (SUPERADMIN)
    // ====================================
    Route::get('/users', [SuperAdminController::class, 'index']);
    Route::post('/users', [SuperAdminController::class, 'store']);
    Route::get('/users/{id}', [SuperAdminController::class, 'show']);
    Route::put('/users/{id}', [SuperAdminController::class, 'update']);
    Route::delete('/users/{id}', [SuperAdminController::class, 'destroy']);
});


Route::middleware(['auth:sanctum'])->group(function () {
    // ====================================
    //    CRUD Progress Proyek API (ADMIN)
    // ====================================
    Route::post('/progress', [ProgressController::class, 'store']);
    Route::get('/progress/project/{projectId}', [ProgressController::class, 'listByProject']);
    Route::get('/progress/{id}', [ProgressController::class, 'show']);
    Route::put('/progress/{id}', [ProgressController::class, 'update']);
    Route::delete('/progress/{id}', [ProgressController::class, 'destroy']);
});


// ====================================
//    FORGOT PASSWORD API
// ====================================
Route::post('/forgot-password', [ForgotPasswordController::class, 'requestReset']);
Route::post('/reset-password', [ForgotPasswordController::class, 'resetPassword']);


Route::middleware('auth:sanctum')->prefix('admin')->group(function () {
    // ====================================
    //    CRUD Project Proyek API (ADMIN)
    // ====================================
    Route::get('/projects', [AdminProjectController::class, 'index']);
    Route::post('/projects', [AdminProjectController::class, 'store']);
    Route::put('/projects/{project}', [AdminProjectController::class, 'update']);
    Route::delete('/projects/{project}', [AdminProjectController::class, 'destroy']);
});

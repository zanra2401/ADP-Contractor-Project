<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// =======================
//   Import Controllers
// =======================
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Admin\DesignController;
use App\Http\Controllers\Admin\ProgressApprovalController;

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

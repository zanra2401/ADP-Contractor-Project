<?php

use App\Http\Controllers\MessageController;
use App\Http\Middleware\EnsurePasswordSecure;
use App\Http\Middleware\EnsureTelpNumValid;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Middleware\AuthMiddleware;
use App\Http\Middleware\LoginMiddleware;
use App\Http\Controllers\Pelanggan\PelangganController;
use App\Http\Controllers\Pelanggan\PaymentController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\CSMiddleware;
use App\Http\Controllers\CS\CSController;
use App\Http\Middleware\PelangganMiddleware;
use App\Http\Controllers\Admin\UserManagementController;
use App\Http\Controllers\Pengawas\PengawasController;
use App\Http\Middleware\PengawasMiddleware;
use App\Http\Controllers\Admin\DesignController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\AdminProjectController;
use App\Http\Controllers\ProgressController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;

/*
|--------------------------------------------------------------------------
| 1. ROUTE BACKEND - USER (REGISTER PENGUNJUNG)
|--------------------------------------------------------------------------
*/


Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'auth')->name('login');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/login', fn() => view('auth.login'))->name('login')->middleware([
    LoginMiddleware::class
]);

Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'auth')->name('login');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/message_send', [MessageController::class, 'sendMessage'])->name('message.send');


/*
|--------------------------------------------------------------------------
| 2. ROUTE AUTENTIKASI & HALAMAN DEPAN
|--------------------------------------------------------------------------
*/

// LANDING PAGE
Route::get('/', function ()  {
    $designs = \App\Models\Design::has('contents')->with('contents')->inRandomOrder()->take(3)->get();
    return view('welcome', compact('designs'));
})->name('home');

// Logout

/*
|--------------------------------------------------------------------------
| 3. ROUTE DASHBOARD PER ROLE
|--------------------------------------------------------------------------
*/

/* --------------------- ADMIN ---------------------- */
Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware([AuthMiddleware::class, AdminMiddleware::class])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/laporan', fn() => view('admin.laporan'))->name('laporan');
        Route::get('/manajemen-konten', fn() => view('admin.manajemen-konten'))->name('manajemen-konten');
        Route::get('/manajemen-proyek', fn() => view('admin.manajemen-proyek'))->name('manajemen-proyek');
        Route::get('/manajemen-proyek/{id}', [AdminProjectController::class, 'showPage'])->name('proyek.detail');
        Route::get('/manajemen-user', [UserManagementController::class, 'index'])->name('manajemen-user');
        Route::get('/chat', fn() => view('admin.chat'))->name('chat');
        Route::get('/payment', fn() => view('admin.payment'))->name('payment');
        Route::get('/simpan-desain', fn() => view('admin.simpan-desain'))->name('simpan-desain');

        Route::get('/approve-progress', fn() => view('admin.approve-progress'))->name('approve-progress');
        Route::get('/set-harga', fn() => view('admin.set-harga'))->name('set-harga');

        // DESIGN MANAGEMENT ROUTES
        Route::get('/design', [DesignController::class, 'index'])->name('design.index');
        Route::get('/design/create', [DesignController::class, 'create'])->name('design.create');
        Route::post('/design/store', [DesignController::class, 'store'])->name('design.store');

        Route::get('/design/{id}/edit', [DesignController::class, 'edit'])->name('design.edit');
        Route::post('/design/{id}/update', [DesignController::class, 'update'])->name('design.update');

        Route::delete('/design/{id}', [DesignController::class, 'destroy'])->name('design.destroy');

        Route::post('/design/{id}/media', [DesignController::class, 'uploadMedia'])->name('design.media.upload');
        Route::delete('/media/{mediaId}', [DesignController::class, 'deleteMedia'])->name('design.media.delete');

        // CATEGORY CRUD
        Route::get('/kategori', [\App\Http\Controllers\Admin\CategoryController::class, 'index'])->name('kategori.index');
        Route::get('/kategori/create', [\App\Http\Controllers\Admin\CategoryController::class, 'create'])->name('kategori.create');
        Route::post('/kategori/store', [\App\Http\Controllers\Admin\CategoryController::class, 'store'])->name('kategori.store');

        Route::get('/kategori/{id}/edit', [\App\Http\Controllers\Admin\CategoryController::class, 'edit'])->name('kategori.edit');
        Route::post('/kategori/{id}/update', [\App\Http\Controllers\Admin\CategoryController::class, 'update'])->name('kategori.update');

        Route::delete('/kategori/{id}', [\App\Http\Controllers\Admin\CategoryController::class, 'destroy'])->name('kategori.destroy');

        // API untuk manajemen proyek 
        Route::get('/api/projects', [AdminProjectController::class, 'index'])->name('api.projects.index');
        Route::post('/api/projects', [AdminProjectController::class, 'store'])->name('api.projects.store');
        Route::get('/api/projects/{id}', [AdminProjectController::class, 'show'])->name('api.projects.show');
        Route::put('/api/projects/{id}', [AdminProjectController::class, 'update'])->name('api.projects.update');
        Route::delete('/api/projects/{id}', [AdminProjectController::class, 'destroy'])->name('api.projects.destroy');
        Route::get('/api/users', [AdminProjectController::class, 'users']);
        Route::get('/api/designs', [AdminProjectController::class, 'designs']);
        //DETAIL PAGE
        Route::get('/manajemen-proyek/{id}', [AdminProjectController::class, 'showPage'])->name('proyek.detail');
        //EDIT
        Route::put('/manajemen-proyek/{id}/update', [AdminProjectController::class, 'updatePage'])->name('manajemen-proyek.update');
        //DELETE
        Route::delete('/manajemen-proyek/{id}/delete', [AdminProjectController::class, 'deletePage'])->name('manajemen-proyek.delete');

        // Progress Log Routes
        Route::get('/upload-progress', function () {
            $projects = \App\Models\Project::all();
            return view('admin.upload-progress', compact('projects'));
        })->name('upload-progress');
        Route::post('/progress', [ProgressController::class, 'store'])->name('progress.store'); 
        Route::get('/progress', [ProgressController::class, 'index'])->name('progress.index');
        Route::get('/progress/{id}/edit', [ProgressController::class, 'show'])->name('progress.edit');
        Route::put('/progress/{id}', [ProgressController::class, 'update'])->name('progress.update');
        Route::delete('/progress/{id}', [ProgressController::class, 'destroy'])->name('progress.destroy');
        
        // Payment management by admin
        Route::put('/payments/{id}', [AdminProjectController::class, 'updatePayment'])->name('payments.update');
        Route::delete('/payments/{id}', [AdminProjectController::class, 'deletePayment'])->name('payments.destroy');

        // Payment progress (installment) management
        Route::put('/payment-progress/{id}', [AdminProjectController::class, 'updatePaymentProgress'])->name('payment-progress.update');
        Route::delete('/payment-progress/{id}', [AdminProjectController::class, 'deletePaymentProgress'])->name('payment-progress.destroy');
    });
});



/* --------------------- PUBLIC GALERI ---------------------- */
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {

    // LIST GALERI → PUBLIC
    Route::get('/galeri', [\App\Http\Controllers\Pelanggan\GaleriController::class, 'index'])
        ->name('galeri');

});

/* --------------------- PELANGGAN ---------------------- */
Route::prefix('pelanggan')->name('pelanggan.')->group(function () {
    Route::get('/register', fn() => view('auth.register'))->name('register');
    Route::middleware([AuthMiddleware::class, PelangganMiddleware::class])->group(function () {
        
        Route::get('/detail-design', [PelangganController::class, 'detailDesign'])->name('detail-design');
    
        Route::post('/pembayaran/{paymentProgress}/snap', [PaymentController::class, 'createSnapToken'])
            ->name('pembayaran.snap');
        Route::get('/pembayaran/{paymentProgress}/invoice', [PaymentController::class, 'invoice'])
            ->name('pembayaran.invoice');
    
        // Route::get('/galeri', [\App\Http\Controllers\Pelanggan\GaleriController::class, 'index'])
        //     ->name('galeri');
    
        Route::get('/galeri/{id}/detail', [\App\Http\Controllers\Pelanggan\GaleriController::class, 'detail'])
            ->name('galeri.detail');
    
        Route::get('/forgot-password', fn() => view('auth.forgot-password'))->name('password.request');
    
        Route::get('/detail-proyek/{id}', [PelangganController::class, 'detailProject'])->name('detail-proyek');

        Route::get('/dashboard', [PelangganController::class, 'dashboard'])
            ->name('dashboard')
            ->middleware([AuthMiddleware::class]);
    
        // Route::get('/galeri', fn() => view('pelanggan.galeri'))->name('galeri');
        Route::get('/chat/{rid?}', [PelangganController::class, 'chat'])->name('chat');
        Route::get('/profil', fn() => view('pelanggan.profil'))->name('profil');

        Route::get('/galeri/detail', fn() => view('pelanggan.detail-desain'))->name('galeri.detail');
    });
});


// Midtrans webhook
Route::post('/payment/midtrans/callback', [PaymentController::class, 'handleCallback'])
    ->name('payment.midtrans-callback')
    ->withoutMiddleware([VerifyCsrfToken::class]);

/* --------------------- PENGAWAS ---------------------- */
Route::prefix('pengawas')->middleware([AuthMiddleware::class, PengawasMiddleware::class])->name('pengawas.')->group(function () {
    // Dashboard handled by Pengawas\DashboardController@index to provide project data
    Route::get('/dashboard', [\App\Http\Controllers\Pengawas\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chat/{rid?}', [PengawasController::class, 'chat'])->name('chat');

    // Detail proyek - use controller for show and update
    Route::get('/detail-proyek/{id}', [\App\Http\Controllers\Pengawas\ProjectController::class, 'show'])->name('detail-proyek');
    Route::put('/detail-proyek/{id}', [\App\Http\Controllers\Pengawas\ProjectController::class, 'update'])->name('detail-proyek.update');

    Route::get('/profil', fn() => view('pengawas.profil'))->name('profil');
    // Route::post('/admin/projects', [AdminProjectController::class, 'store']);
});

/* --------------------- CUSTOMER SERVICE ---------------------- */
Route::prefix('cs')->name('cs.')->group(function () {
    Route::middleware([AuthMiddleware::class, CSMiddleware::class])->group(function () {
        Route::get('/dashboard/{rid?}', [CSController::class, 'chat'])->name('dashboard');
        Route::get('/profil', fn() => view('CS.profil'))->name('profil');
    });
});

/* --------------------- SUPERADMIN ---------------------- */
Route::prefix('superadmin')->group(function () {
    Route::get('/manajemen-admin', function () {
        return view('superadmin.manajemen-admin');
    })->name('superadmin.manajemen-admin');

    Route::get('/users', [SuperAdminController::class, 'index']);
    Route::post('/users', [SuperAdminController::class, 'store']);
    Route::get('/users/{id}', [SuperAdminController::class, 'show']);
    Route::put('/users/{id}', [SuperAdminController::class, 'update']);
    Route::delete('/users/{id}', [SuperAdminController::class, 'destroy']);
});


/* --------------------- FORGOT PASSWORD ---------------------- */
Route::post('/forgot-password/request', [ForgotPasswordController::class, 'requestReset'])->name('forgot.request');
Route::post('/forgot-password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('forgot.reset');
Route::get('/forgot-password', function () {return view('auth.forgot-password');})->name('password.request');
Route::post('/forgot-password/verify', [ForgotPasswordController::class, 'verifyCode'])->name('forgot.verify');

Route::prefix("project")->name("project.")->group(function() {
    Route::post("/create", [\App\Http\Controllers\ProjectController::class, 'createProject'])->name('create');
});
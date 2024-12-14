<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\KelolaAkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\PengaduanController;
use App\Models\Pengaduan;

// Halaman Landing
Route::get('/', function () {
    return view('pages.landing_page');
})->name('landing_page');

Route::get('/dashboard', [DashboardController::class, 'index'])->name('guest.dashboard');

// Halaman Login & Logout
Route::get('/login', [KelolaAkunController::class, 'index'])->name('login');
Route::post('/login', [KelolaAkunController::class, 'loginAuth'])->name('login.auth');
Route::get('/logout', [KelolaAkunController::class, 'logout'])->name('logout');

// Middleware untuk pengguna yang sudah login
Route::middleware('IsLogin')->group(function () {
    // Dashboard
});

// API Routes
Route::prefix('api')->group(function () {
    Route::get('/provinces', [PengaduanController::class, 'getProvinces'])->name('pengaduan.provinces');
    Route::get('/cities/{provinceId}', [PengaduanController::class, 'getCities'])->name('pengaduan.cities');
    Route::get('/districts/{cityId}', [PengaduanController::class, 'getDistricts'])->name('pengaduan.districts');
    Route::get('/villages/{districtId}', [PengaduanController::class, 'getVillages'])->name('pengaduan.villages');
});

// Debugging User Login Status
Route::get('/user', function () {
    return auth()->user() ? 'Sudah login' : 'Belum login';
})->name('user.status');

// Pengaduan Routes
Route::middleware(['guest'])->group(function () {
    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
        Route::get('/create', [PengaduanController::class, 'create'])->name('create');
        Route::post('/store', [PengaduanController::class, 'store'])->name('store');
        Route::get('/', [PengaduanController::class, 'index'])->name('index');
        Route::get('/{id}', [PengaduanController::class, 'show'])->name('show');
        Route::post('/vote/{id}', [PengaduanController::class, 'vote'])->name('vote');
        Route::post('/comment/{id}', [PengaduanController::class, 'comment'])->name('comment');
    });
});

// Filter berdasarkan provinsi
Route::get('/pengaduan/filter/{provinsi}', [PengaduanController::class, 'filterByProvinsi'])->name('pengaduan.filterByProvinsi');

Route::get('/pengaduan/{id}', function ($id) {
    $pengaduan = Pengaduan::find($id);
    if ($pengaduan) {
        return response()->json($pengaduan);
    } else {
        return response()->json(['error' => 'Data tidak ditemukan'], 404);
    }
});


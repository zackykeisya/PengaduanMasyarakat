<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\KelolaAkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Api\PengaduanController;
use App\Http\Controllers\AuthController;
use App\Models\Pengaduan;

// Landing Page
Route::get('/', function () {
    return view('pages.landing_page'); // Halaman landing
})->name('landing.page');


Route::middleware(['auth', 'guest.role'])->group(function () {
    Route::get('/guest/dashboard', function () {
        return view('guest.dashboard');
    })->name('guest.dashboard');
});

Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout.auth');



// Register
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.auth');

// Login
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.auth');

// Dashboard
Route::middleware(['auth'])->get('/guest/dashboard', [DashboardController::class, 'index'])->name('guest.dashboard');

Route::get('/guest/dashboard', [DashboardController::class, 'index'])->name('guest.dashboard');

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

    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
        Route::get('/create', [PengaduanController::class, 'create'])->name('pengaduan.create');
        Route::post('/store', [PengaduanController::class, 'store'])->name('store');
        Route::get('/', [PengaduanController::class, 'index'])->name('index');
    });

Route::get('/pengaduan/{id}', [PengaduanController::class, 'show'])->name('pengaduan.show');
Route::post('/pengaduan/vote/{id}', [PengaduanController::class, 'vote'])->name('pengaduan.vote');
Route::post('/pengaduan/comment/{id}', [PengaduanController::class, 'comment'])->name('pengaduan.comment');

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


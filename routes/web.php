<?php

use App\Exports\LaporanExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\StokController;
use App\Models\Kategori;
use App\Models\Laporan;
use App\Models\Stok;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return redirect('/dashboard');
})->middleware('auth');

Route::get('/dashboard', function () {
    $jumlah_kategori = Kategori::count();
    $jumlah_stok = Stok::whereRaw('DATE(created_at) = CURDATE()')->get();
    $jumlah_arm = Laporan::where('jumlah_masuk', '>', 0)->count(); // Menghitung jumlah arus barang masuk
    $jumlah_ark = Laporan::where('jumlah_keluar', '>', 0)->count(); // Menghitung jumlah arus barang keluar
    return view('dashboard', compact('jumlah_kategori', 'jumlah_stok', 'jumlah_arm', 'jumlah_ark'));

})->name('dashboard')->middleware('auth');

Route::get('/laporan/download', function () {
    return view('download-laporan');  // Halaman form untuk memilih rentang tanggal
})->name('laporan.form');

Route::get('/laporan/export', function (Request $request) {
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');

    return Excel::download(new LaporanExport($start_date, $end_date), 'laporan_barang.xlsx');
})->name('laporan.download');

Route::get('/tables', function () {
    return view('tables');
})->name('tables')->middleware('auth');

Route::get('/profile', function () {
    return view('account-pages.profile');
})->name('profile')->middleware('auth');

Route::get('/signin', function () {
    return view('account-pages.signin');
})->name('signin');

Route::get('/signup', function () {
    return view('account-pages.signup');
})->name('signup')->middleware('guest');

Route::get('/sign-up', [RegisterController::class, 'create'])
    ->middleware('guest')
    ->name('sign-up');

Route::post('/sign-up', [RegisterController::class, 'store'])
    ->middleware('guest');

Route::get('/sign-in', [LoginController::class, 'create'])
    ->middleware('guest')
    ->name('sign-in');

Route::post('/sign-in', [LoginController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [LoginController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');

Route::get('/forgot-password', [ForgotPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'store'])
    ->middleware('guest');

Route::get('/laravel-examples/user-profile', [ProfileController::class, 'index'])->name('users.profile')->middleware('auth');
Route::put('/laravel-examples/user-profile/update', [ProfileController::class, 'update'])->name('users.update')->middleware('auth');
Route::get('/laravel-examples/users-management', [UserController::class, 'index'])->name('users-management')->middleware('auth');

Route::resource('kategori', KategoriController::class)->middleware('auth');
Route::resource('stok', StokController::class)->middleware('auth');
Route::resource('laporan', LaporanController::class)->middleware('auth');
// Arus Barang Masuk
Route::get('/arus-barang-masuk', [LaporanController::class, 'barangMasuk'])->name('barang-masuk.index')->middleware('auth');
Route::get('/arus-barang-masuk/create', [LaporanController::class, 'createBarangMasuk'])->name('barang-masuk.create')->middleware('auth');
Route::post('/arus-barang-masuk', [LaporanController::class, 'storeBarangMasuk'])->name('barang-masuk.store')->middleware('auth');
Route::get('/arus-barang-masuk/{laporan_id}/edit', [LaporanController::class, 'editBarangMasuk'])->name('barang-masuk.edit')->middleware('auth');
Route::put('/arus-barang-masuk/{laporan_id}', [LaporanController::class, 'updateBarangMasuk'])->name('barang-masuk.update')->middleware('auth');
Route::delete('/arus-barang-masuk/{laporan_id}', [LaporanController::class, 'destroyBarangMasuk'])->name('barang-masuk.destroy')->middleware('auth');


// Arus Barang Keluar
Route::get('/arus-barang-keluar', [LaporanController::class, 'barangKeluar'])->name('barang-keluar.index')->middleware('auth');
Route::get('/arus-barang-keluar/create', [LaporanController::class, 'createBarangKeluar'])->name('barang-keluar.create')->middleware('auth');
Route::post('/arus-barang-keluar', [LaporanController::class, 'storeBarangKeluar'])->name('barang-keluar.store')->middleware('auth');
Route::get('/arus-barang-keluar/{laporan_id}/edit', [LaporanController::class, 'editBarangKeluar'])->name('barang-keluar.edit')->middleware('auth');
Route::put('/arus-barang-keluar/{laporan_id}', [LaporanController::class, 'updateBarangKeluar'])->name('barang-keluar.update')->middleware('auth');
Route::delete('/arus-barang-keluar/{laporan_id}', [LaporanController::class, 'destroyBarangKeluar'])->name('barang-keluar.destroy')->middleware('auth');




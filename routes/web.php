<?php

use App\Http\Controllers\AkunChildController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\Laporan\LaporanBukuBesarController;
use App\Http\Controllers\Laporan\LaporanBukuKecilController;
use App\Http\Controllers\Laporan\LaporanSecondController;
use App\Http\Controllers\Laporan\LaporanGabunganController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\SubAkunController;
use App\Http\Controllers\SubSubAkunController;
use App\Http\Controllers\Transaksi\BukuBesarController;
use App\Http\Controllers\Transaksi\BukuKecilController;
use App\Http\Controllers\Transaksi\SecondController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Only authenticated users may access this route...
    Route::resource('kategori', KategoriController::class);
    Route::resource('sub_akun', SubAkunController::class);
    Route::resource('sub_sub_akun', SubSubAkunController::class);
    Route::resource('akun', AkunController::class);
    Route::resource('akun_child', AkunChildController::class);
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('buku_besar', BukuBesarController::class);
    Route::resource('buku_kecil', BukuKecilController::class);
    Route::resource('second', SecondController::class);
    Route::resource('laporan_buku_besar', LaporanBukuBesarController::class);
    Route::resource('laporan_buku_kecil', LaporanBukuKecilController::class);
    Route::resource('laporan_second', LaporanSecondController::class);
    Route::resource('laporan_gabungan', LaporanGabunganController::class);


    // Route::get('kategori_sub_akun/{kategori}', [ SubAkunController::class,  'akun'])->name('kategori.akun');
    Route::get('kategori_akun/{kategori}', [ AkunController::class,  'akunList'])->name('kategori.akun');
    Route::get('data_akun/{akun}/{level}', [ AkunController::class,  'akun'])->name('sub.akun');

    Route::get('detail_sub_akun_akun/{akun}', [ SubSubAkunController::class,  'akun'])->name('subakun.akun');
    Route::get('detail_akun/{akun}', [ AkunController::class,  'akun'])->name('akun.subakun.akun');
    Route::get('detail_akun_child/{akun}', [ AkunChildController::class,  'akun'])->name('akunchild.subakun.akun');

    Route::get('akun_existance/{akun}', [AkunController::class, 'existance']);
    Route::get('buku_besar_data', [BukuBesarController::class, 'data'])->name('buku_besar.data');
    Route::get('buku_kecil_data', [BukuKecilController::class, 'data'])->name('buku_kecil.data');
    Route::get('second_data', [SecondController::class, 'data'])->name('second.data');

    // Dashboard
    Route::get('dashboard_pemasukan_hari_ini', [DashboardController::class, 'pemasukan_hari_ini'])->name('dashboard.pemasukan.hari.ini');
    Route::get('dashboard_pemasukan_bulan_ini', [DashboardController::class, 'pemasukan_bulan_ini'])->name('dashboard.pemasukan.bulan.ini');
    Route::get('dashboard_pengeluaran_hari_ini', [DashboardController::class, 'pengeluaran_hari_ini'])->name('dashboard.pengeluaran.hari.ini');
    Route::get('dashboard_pengeluaran_bulan_ini', [DashboardController::class, 'pengeluaran_bulan_ini'])->name('dashboard.pengeluaran.bulan.ini');
    Route::get('dashboard_pemasukan_tahun_ini', [DashboardController::class, 'pemasukan_tahun_ini'])->name('dashboard.pemasukan.tahun.ini');
    Route::get('dashboard_pengeluaran_tahun_ini', [DashboardController::class, 'pengeluaran_tahun_ini'])->name('dashboard.pengeluaran.tahun.ini');
    Route::get('dashboard_seluruh_pemasukan', [DashboardController::class, 'seluruh_pemasukan'])->name('dashboard.seluruh.pemasukan');
    Route::get('dashboard_seluruh_pengeluaran', [DashboardController::class, 'seluruh_pengeluaran'])->name('dashboard.seluruh.pengeluaran');
    
    Route::get('dashboard_bulan_tahun_ini', [DashboardController::class, 'data_bulan_tahun_ini'])->name('dashboard.bulan.tahun.ini');
    Route::get('dashboard_tahunan', [DashboardController::class, 'data_tahunan'])->name('dashboard.tahunan');
    // /Dashboard

    // preview pdf
    Route::get('export_pdf', [LaporanBukuBesarController::class, 'export_pdf'])->name('export.pdf');
    Route::get('export_buku_kecil_pdf', [LaporanBukuKecilController::class, 'export_pdf'])->name('export.bukukecil.pdf');
    Route::get('export_second_pdf', [LaporanSecondController::class, 'export_pdf'])->name('export.second.pdf');
    Route::get('export_gabungan_pdf', [LaporanGabunganController::class, 'export_pdf'])->name('export.gabungan.pdf');
    Route::get('preview_pdf', [LaporanBukuBesarController::class, 'preview_pdf'])->name('preview.pdf');    
});


Route::get('login', [AuthController::class, 'login'])->name('login');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::post('authenticate', [AuthController::class, 'authenticate'])->name('login.authenticate');
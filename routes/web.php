<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PenilaianController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\ManajemenPenilaianController;
use App\Http\Controllers\LaporanKinerjaController;
use App\Http\Controllers\LaporanKeahlianController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::group([
    'middleware' => 'web'
], function ($router) {
//Dashboard
Route::get('/', [DashboardController::class, 'index']); 

//Login
Route::get('signin', [UserController::class, 'index'])->name('signin');
Route::post('signin-auth', [UserController::class, 'signin'])->name('signin.auth'); 
Route::get('signout', [UserController::class, 'signout'])->name('signout');

//Profile
Route::get('profile', [ProfilController::class, 'index']);
Route::put('profile-change', [ProfilController::class, 'profileChange'])->name('profile.change');
Route::put('pass-change', [ProfilController::class, 'passChange'])->name('pass.change'); 

//User Data
Route::get('list-karyawan', [KaryawanController::class, 'index']);
Route::post('add-user', [KaryawanController::class, 'addUser'])->name('add.user'); 
Route::get('ubah-karyawan', [KaryawanController::class, 'ubahKaryawan']); 
Route::put('change-user', [KaryawanController::class, 'changeUser'])->name('change.user'); 
Route::get('deactivate-karyawan', [KaryawanController::class, 'deactivateKaryawan']); 
Route::get('activate-user/{idkaryawan}', [KaryawanController::class, 'activateUser']); 
Route::get('deactivate-user/{idkaryawan}', [KaryawanController::class, 'deactivateUser']); 

//Role Data
Route::get('ubah-role/user', [RoleController::class, 'ubahRoleUser']); 
Route::put('change-role', [RoleController::class, 'changeRole'])->name('change.role'); 
Route::get('list-role', [RoleController::class, 'index']);
Route::post('add-role', [RoleController::class, 'addRole'])->name('add.role'); 
Route::get('hapus-role/{idrole}', [RoleController::class, 'deleteRole']); 

//Penilaian
Route::get('list-kinerja', [PenilaianController::class, 'listKinerja']);
Route::post('add-kategori', [PenilaianController::class, 'addKategori'])->name('add.kategori'); 
Route::get('hapus-kategori/{idkategori}', [PenilaianController::class, 'deleteKategori']); 
Route::put('change-kategori', [PenilaianController::class, 'changeKategori'])->name('change.kategori'); 
Route::post('add-kinerja', [PenilaianController::class, 'addKinerja'])->name('add.kinerja'); 
Route::put('change-kinerja', [PenilaianController::class, 'changeKinerja'])->name('change.kinerja'); 
Route::get('hapus-kinerja/{idkinerja}', [PenilaianController::class, 'deleteKinerja']); 

Route::get('list-keahlian', [PenilaianController::class, 'listKeahlian']);
Route::post('add-keahlian', [PenilaianController::class, 'addKeahlian'])->name('add.keahlian'); 
Route::put('change-keahlian', [PenilaianController::class, 'changeKeahlian'])->name('change.keahlian'); 
Route::get('hapus-keahlian/{idkeahlian}', [PenilaianController::class, 'deleteKeahlian']); 

//Divisi
Route::get('list-divisi', [DivisiController::class, 'listDivisi']);
Route::post('add-divisi', [DivisiController::class, 'addDivisi'])->name('add.divisi'); 
Route::put('change-divisi', [DivisiController::class, 'changeDivisi'])->name('change.divisi'); 
Route::get('hapus-divisi/{iddivisi}', [DivisiController::class, 'deleteDivisi']);

//Manajemen Penilaian Kinerja
Route::get('penilaian-kinerja', [ManajemenPenilaianController::class, 'penilaianKinerja']);
Route::post('add-penilaian-kinerja', [ManajemenPenilaianController::class, 'addPenilaianKinerja'])->name('add.penilaian.kinerja');
Route::get('edit-penilaian-kinerja', [ManajemenPenilaianController::class, 'editPenilaianKinerja']);
Route::put('change-penilaian-kinerja', [ManajemenPenilaianController::class, 'changePenilaianKinerja'])->name('change.penilaian.kinerja'); 

//Manajemen Penilaian Keahlian
Route::get('penilaian-keahlian', [ManajemenPenilaianController::class, 'penilaianKeahlian']);
Route::post('add-penilaian-keahlian', [ManajemenPenilaianController::class, 'addPenilaianKeahlian'])->name('add.penilaian.keahlian');
Route::get('edit-penilaian-keahlian', [ManajemenPenilaianController::class, 'editPenilaianKeahlian']);
Route::put('change-penilaian-keahlian', [ManajemenPenilaianController::class, 'changePenilaianKeahlian'])->name('change.penilaian.keahlian'); 

//Laporan Penilaian Kinerja
Route::get('laporan-penilaian-kinerja/divisi', [LaporanKinerjaController::class, 'laporanDivisi']);
Route::get('export-divisi-pdf/{bulan}/{id_divisi}', [LaporanKinerjaController::class, 'exportDivisi']);
Route::get('laporan-penilaian-kinerja', [LaporanKinerjaController::class, 'laporanKaryawan']);
Route::get('export-karyawan-pdf/{bulan}/{id_karyawan}', [LaporanKinerjaController::class, 'exportKaryawanPDF']);
Route::get('export-karyawan-excel/{bulan}/{id_karyawan}', [LaporanKinerjaController::class, 'exportKaryawanExcel']);

//Laporan Penilaian Keahlian
Route::get('laporan-penilaian-keahlian/divisi', [LaporanKeahlianController::class, 'laporanDivisi']);
Route::get('export-keahlian-divisi-pdf/{bulan}/{id_divisi}', [LaporanKeahlianController::class, 'exportDivisi']);
Route::get('laporan-penilaian-keahlian', [LaporanKeahlianController::class, 'laporanKaryawan']);
Route::get('export-keahlian-pdf/{bulan}/{id_karyawan}/{id_divisi}', [LaporanKeahlianController::class, 'exportKaryawanPDF']);
Route::get('export-keahlian-excel/{bulan}/{id_karyawan}/{id_divisi}', [LaporanKeahlianController::class, 'exportKaryawanExcel']);

});
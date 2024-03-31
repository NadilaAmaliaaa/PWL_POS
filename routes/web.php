<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\POSController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/level/create', [LevelController::class, 'create']);
Route::post('/level', [LevelController::class, 'store']);
Route::get('/level/ubah/{id}', [LevelController::class, 'ubah']);
Route::put('/level/ubah_simpan/{id}', [LevelController::class, 'ubah_simpan']);
Route::get('/level/hapus/{id}', [LevelController::class, 'hapus']);

Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/kategori/create', [KategoriController::class, 'create']);
Route::post('/kategori', [KategoriController::class, 'store']);
Route::get('/kategori/ubah/{id}', [KategoriController::class, 'ubah']);
Route::put('/kategori/ubah_simpan/{id}', [KategoriController::class, 'ubah_simpan']);
Route::get('/kategori/hapus/{id}', [KategoriController::class, 'hapus']);

Route::get('/user', [UserController::class, 'index']);
Route::get('/user/create', [UserController::class, 'tambah']);
Route::post('/user', [UserController::class, 'store']);
Route::get('/user/ubah/{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan/{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus/{id}', [UserController::class, 'hapus']);

//M_USER
Route::get('/m_user', [POSController::class, 'index'])->name('m_user.index');
Route::get('/m_user/show', [POSController::class, 'show'])->name('m_user.show');
Route::get('/m_user/create', [POSController::class, 'create'])->name('m_user.create');
Route::post('/m_user', [POSController::class, 'store'])->name('m_user.store');
Route::get('/m_user/edit/{id}', [POSController::class, 'edit'])->name('m_user.edit');
Route::put('/m_user/update/{id}', [POSController::class, 'update'])->name('m_user.update');
Route::get('/m_user/delete/{id}', [POSController::class, 'destroy'])->name('m_user.destroy');

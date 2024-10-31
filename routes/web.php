<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
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

Route::get('/', [GuestController::class, 'index'])->name('home');
Route::get('/berita', [GuestController::class, 'showBerita'])->name('berita');
Route::get('/berita/{id}', [GuestController::class, 'detailBerita']);
Route::get('/umkm', [GuestController::class, 'showUmkm'])->name('umkm');
Route::get('/umkm/{id}', [GuestController::class, 'detailUmkm']);
Route::get('/about', [GuestController::class, 'showStruktur'])->name('about');

Route::get('/auth', function(){
    return view('auth');
})->name('login')->middleware('guest');

Route::post('/auth/login', [AdminController::class, 'login'])->name('auth.login');
Route::post('/auth/logout', [AdminController::class, 'logout'])->name('auth.logout');

//Route Admin
Route::middleware(['auth'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/admin/profil', [AdminController::class, 'showProfile'])->name('profil.desa');
    Route::get('/admin/berita', [AdminController::class, 'showBerita'])->name('admin.berita');
    Route::get('/admin/umkm', [AdminController::class, 'showUmkm'])->name('admin.umkm');
    Route::get('/admin/user', [AdminController::class, 'showUser'])->name('admin.user')->middleware('onlyadmin');
    Route::get('/admin/adduser', [AdminController::class, 'addUser'])->name('admin.adduser')->middleware('onlyadmin');
    Route::post('/admin/adduser', [AdminController::class, 'createUser'])->middleware('onlyadmin');
    Route::delete('/admin/user/delete/{id}', [AdminController::class, 'deleteUser'])->middleware('onlyadmin');
    Route::get('/admin/401', function(){return view('admin.notauth');})->name('admin.notauth');
    Route::get('/admin/user/edit/{id}', [AdminController::class, 'editUser'])->middleware('onlyadmin');
    Route::post('/admin/user/update/{id}', [AdminController::class, 'updateUser'])->middleware('onlyadmin');
    Route::delete('/admin/berita/delete/{id}', [AdminController::class, 'deleteBerita']);
    Route::get('/admin/berita/edit/{id}', [AdminController::class, 'editBerita']);
    Route::post('/admin/berita/edit/{id}', [AdminController::class, 'updateBerita']);
    Route::get('/admin/perangkat', [AdminController::class, 'showPerangkat'])->name('perangkat.desa');
    Route::get('/admin/perangkat/add', [AdminController::class, 'addPerangkat']);
    Route::post('/admin/perangkat/add', [AdminController::class, 'submitPerangkat']);
    Route::get('/admin/perangkat/edit/{id}', [AdminController::class, 'editPerangkat']);
    Route::post('/admin/perangkat/update/{id}', [AdminController::class, 'updatePerangkat']);

    Route::get('/admin/berita/upload', [AdminController::class, 'showUploadBerita'])->name('admin.berita.upload');
    Route::post('/admin/berita/upload', [AdminController::class, 'uploadBerita'])->name('admin.berita.upload');
    Route::get('/admin/umkm/upload', [AdminController::class, 'showUploadUmkm'])->name('admin.umkm.upload');
    Route::post('/admin/umkm/upload', [AdminController::class, 'uploadUmkm'])->name('admin.umkm.upload');
    Route::delete('/admin/umkm/delete/{id}', [AdminController::class, 'deleteUmkm']);
    Route::get('/admin/umkm/edit/{id}', [AdminController::class, 'editUmkm']);
    Route::post('/admin/umkm/edit/{id}', [AdminController::class, 'updateUmkm']);
    Route::post('/admin/profil/update', [AdminController::class, 'updateDataProfil']);
});

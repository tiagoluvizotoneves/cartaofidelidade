<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\CardController;
use App\Http\Controllers\Admin\RewardController;
use App\Http\Controllers\Admin\StampController;
use App\Http\Controllers\Admin\UserMetaSaasController;

Route::get('/', function () {
    return view('welcome');
});

// Dashboard padrão do Breeze (pode ser mantido ou redirecionar pro admin)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Rotas de perfil padrão do Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🔐 Rotas administrativas
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/companies', CompanyController::class);
    Route::resource('/cards', CardController::class);
    Route::resource('/stamps', StampController::class);
    Route::resource('/rewards', RewardController::class);
    Route::resource('/user-meta-saas', UserMetaSaasController::class);
});

require __DIR__ . '/auth.php';

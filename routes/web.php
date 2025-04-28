<?php

use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\CategorieController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use UniSharp\LaravelFilemanager\Lfm;


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

//public akses
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('article/{slug}', [HomeController::class, 'show'])->name('home.detail');
    
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::prefix('admin')->middleware(['auth', 'role:admin,editor,author'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.admin');
    Route::resource('user', UserController::class);
    Route::resource('category', CategorieController::class);
    Route::resource('article', ArticleController::class);


});


require __DIR__.'/auth.php';

<?php

use App\Http\Controllers\Backend\ArticleController;
use App\Http\Controllers\Backend\CategorieController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProfilController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\MediaController;
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


Route::prefix('admin')->middleware(['web','auth', 'role:admin,editor,author'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    
    // Chart routes
    Route::get('/dashboard/stats', [DashboardController::class, 'getDashboardStats'])->name('admin.dashboard.stats');
    Route::get('/dashboard/chart-data', [DashboardController::class, 'chartData'])->name('admin.dashboard.chart.data');
    Route::get('/dashboard/chart-articles', [DashboardController::class, 'getArticleChart'])->name('admin.dashboard.chart.articles');
    
    // Article fetch
    Route::get('/dashboard/articles/fetch', [DashboardController::class, 'fetchArticles'])->name('admin.dashboard.articles.fetch');

    // Users last login
    Route::get('/dashboard/last-login', [DashboardController::class, 'getLastLoggedInUsers'])->name('admin.dashboard.last-login');

    Route::resource('user', UserController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('category', CategorieController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::resource('article', ArticleController::class);
    Route::resource('profil', ProfilController::class)->only(['index', 'store', 'update', 'destroy']);
    Route::post('media/upload', [MediaController::class, 'upload'])->name('media.upload');
    Route::resource('tag', TagController::class)->only(['index', 'store', 'update', 'destroy']);
});



require __DIR__.'/auth.php';

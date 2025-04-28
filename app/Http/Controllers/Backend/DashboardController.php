<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function getDashboardStats()
    {
        $stats = [
            'totalArtikel' => Article::count(),
            'totalPublished' => Article::where('publish_status', 'published')->count(),
            'totalUser' => User::count(),
            'totalKategori' => Categorie::count(),
        ];
    
        return response()->json($stats);
    }

    public function chartData()
{
    $data = Article::selectRaw('MONTH(published_at) as month, COUNT(*) as total_views')
        ->whereYear('published_at', date('Y'))
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    $labels = [];
    $values = [];

    foreach ($data as $row) {
        $labels[] = date('F', mktime(0, 0, 0, $row->month, 1)); // Nama bulan
        $values[] = $row->total_views;
    }

    return response()->json([
        'labels' => $labels,
        'values' => $values,
    ]);
}

public function getArticleChart()
{
    $articles = DB::table('articles')
        ->selectRaw('MONTH(published_at) as month, COUNT(*) as total')
        ->whereYear('published_at', date('Y')) // hanya tahun ini
        ->groupBy('month')
        ->orderBy('month')
        ->get();

    // Siapkan label bulan (Januari, Februari, dll)
    $allMonths = collect(range(1, 12))->map(function ($month) {
        return Carbon::create()->month($month)->locale('id')->isoFormat('MMMM'); // Bahasa Indonesia
    });

    // Ambil data sesuai bulan
    $articleData = [];
    foreach (range(1, 12) as $month) {
        $found = $articles->firstWhere('month', $month);
        $articleData[] = $found ? $found->total : 0;
    }

    return response()->json([
        'labels' => $allMonths,
        'data' => $articleData,
    ]);
}

public function fetchArticles()
{
    $articles = Article::select('title', 'publish_status', 'published_at')
        ->orderBy('published_at', 'desc')
        ->get();

    return response()->json($articles);
}

// UserController.php
public function getLastLoggedInUsers()
{
    $users = User::orderBy('updated_at', 'desc') // Mengurutkan berdasarkan waktu update terakhir (atau last_login_at jika ada)
                ->take(3) // Mengambil 3 pengguna terakhir
                ->get();

    return view('backend.dashboard.dashboard', compact('users'));
}


}

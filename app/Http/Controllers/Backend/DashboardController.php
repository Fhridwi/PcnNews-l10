<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalArtikel = Article::count();
        $totalPublished = Article::where('publish_status', 'published')->count();
        $totalUser = User::count();
        $totalKategori = Categorie::count();

        return view('backend.dashboard.dashboard', compact(
            'totalArtikel',
            'totalPublished',
            'totalUser',
            'totalKategori'
        ));
    }
}

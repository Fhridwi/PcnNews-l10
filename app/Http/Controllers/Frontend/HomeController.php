<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $latest_post = Article::orderBy('view_count', 'desc')
            ->first(); 
    
        // Mendapatkan artikel trending (yang paling banyak dilihat dalam 7 hari terakhir)
        $trending_articles = Article::with(['author', 'categories'])
            ->where('publish_status', 'published')  // Artikel yang sudah diterbitkan
            ->where('published_at', '<=', Carbon::now())  // Artikel yang diterbitkan hingga saat ini
            ->where('published_at', '>=', Carbon::now()->subDays(7))  // Artikel yang diterbitkan dalam 7 hari terakhir
            ->orderBy('view_count', 'desc')  // Mengurutkan berdasarkan jumlah view terbanyak
            ->take(4)  // Mengambil 5 artikel teratas
            ->get();
    
       // Mendapatkan artikel terbaru berdasarkan tanggal penerbitan
            $recent_articles = Article::with(['author', 'categories'])
            ->where('publish_status', 'published')  // Artikel yang sudah diterbitkan
            ->where('published_at', '<=', Carbon::now())  // Artikel yang diterbitkan hingga saat ini
            ->orderBy('published_at', 'desc')  // Mengurutkan berdasarkan tanggal penerbitan terbaru
            ->paginate(3);  // Mengambil 6 artikel terbaru per halaman

        // Mendapatkan kategori populer berdasarkan jumlah artikel yang diterbitkan
        $popular_categories = Categorie::withCount(['articles' => function($query) {
                $query->where('publish_status', 'published')  // Artikel yang sudah diterbitkan
                    ->where('published_at', '<=', Carbon::now());  // Artikel yang diterbitkan hingga saat ini
            }])
            ->orderBy('articles_count', 'desc')  // Mengurutkan kategori berdasarkan jumlah artikel terbanyak
            ->take(6)  // Mengambil 6 kategori teratas
            ->get();
    
        // Mendapatkan semua kategori untuk filter
        $categories = Categorie::all();
    
        // Mengirim data ke tampilan 'frontend.home' yang sudah disiapkan
        return view('frontend.home', compact(
            'latest_post',  // Artikel terbaru
            'trending_articles',  // Artikel trending
            'recent_articles',  // Artikel terbaru berdasarkan tanggal
            'popular_categories',  // Kategori populer
            'categories'  // Semua kategori untuk filter
        ));
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();
        return view('frontend.article.show', compact('article'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

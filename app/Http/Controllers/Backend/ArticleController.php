<?php

// app/Http/Controllers/ArticleController.php
namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\ArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class ArticleController extends Controller
{

    public function index()
    {
        if (request()->ajax()) {
            $articles = Article::with('categories')->select('articles.*')->latest();

            return DataTables::of($articles)
                ->addIndexColumn()
                ->addColumn('categories', function ($articles) {
                    return $articles->categories->pluck('name')->implode(', ');
                })
                ->addColumn('publish_status', function ($article) {
                    $status = $article->publish_status;
                    // Menambahkan badge sesuai status
                    if ($status == 'published') {
                        return '<span class="badge badge-success">Published</span>';
                    } elseif ($status == 'draft') {
                        return '<span class="badge badge-warning">Draft</span>';
                    } elseif ($status == 'archived') {
                        return '<span class="badge badge-secondary">Archived</span>';
                    } elseif ($status == 'private') {
                        return '<span class="badge badge-secondary">Private</span>';
                    }
                })
                ->addColumn('action', function ($article) {
                    return '
                        <a href="' . route('article.show', $article->id) . '" class="btn btn-sm btn-info">Detail</a>
                        <a href="' . route('article.edit', $article->id) . '" class="btn btn-sm btn-primary">Edit</a>
                        <form action="' . route('article.destroy', $article->id) . '" method="POST" style="display:inline;" id="deleteForm-' . $article->id . '">
                            ' . csrf_field() . method_field('DELETE') . '
                            <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete(' . $article->id . ')">Hapus</button>
                        </form>
                    ';
                })
                ->rawColumns(['action', 'publish_status'])
                ->make(true);
        }

        return view('Backend.article.article_index');
    }

    public function create()
    {
        $categories = Categorie::all();
        $tags = Tag::all();
        return view('backend.article.article_create', compact('categories', 'tags'));
    }
    // Store a newly created article in the database
    public function store(ArticleRequest $request)
    {
        // Validasi data
        $data = $request->validated();

        if ($request->hasFile('cover_image_url')) {
            $file = $request->file('cover_image_url');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();

            if (!Storage::exists('public/back')) {
                Storage::makeDirectory('public/back');
            }

            $file->storeAs('public/back', $fileName);

            $data['cover_image_url'] = 'storage/back/' . $fileName;
        }

        // Membuat artikel baru
        $article = Article::create([
            'title' => $data['title'],
            'slug' => Str::slug($data['title']),
            'summary' => $data['summary'],
            'content' => $data['content'],
            'cover_image_url' => $data['cover_image_url'] ?? null,
            'publish_status' => $data['publish_status'],
            'published_at' => $data['published_at'],
            'view_count' => 0,
            'author_id' => Auth::user()->id,
        ]);

        // Menambahkan kategori ke artikel
        if ($request->has('categories')) {
            $article->categories()->attach($request->categories);
        }

        // Menambahkan tag ke artikel
        if ($request->has('tags')) {
            $article->tags()->attach($request->tags);
        }

        return redirect()->route('article.index')->with('success', 'Artikel berhasil dibuat.');
    }


    public function show($id)
    {
        $article = Article::with('categories', 'tags')->findOrFail($id);
        return view('backend.article.article_show', compact('article'));
    }

    public function edit(Article $article)
    {
        // Retrieve all categories and tags for the dropdown
        $categories = Categorie::all();
        $tags = Tag::all();

        return view('backend.article.article_edit', compact('article', 'categories', 'tags'));
    }

    // Update the specified article in the database
    public function update(UpdateArticleRequest $request, Article $article)
    {
        $request->validated();  
    
        $data = $request->all();
    
        if ($request->hasFile('cover_image_url')) {
            if ($article->cover_image_url && Storage::exists(str_replace('storage/', 'public/', $article->cover_image_url))) {
                Storage::delete(str_replace('storage/', 'public/', $article->cover_image_url));
            }
    
            $file = $request->file('cover_image_url');
            $fileName = uniqid() . '.' . $file->getClientOriginalExtension();
    
            if (!Storage::exists('public/back')) {
                Storage::makeDirectory('public/back');
            }
    
            $file->storeAs('public/back', $fileName);
    
            $data['cover_image_url'] = 'storage/back/' . $fileName;
        } else {
            $data['cover_image_url'] = $article->cover_image_url;
        }
    
        $slug = Str::slug($data['title']);
        if (Article::where('slug', $slug)->where('id', '!=', $article->id)->exists()) {
            $slug = $slug . '-' . uniqid();
        }
    
        $article->update([
            'title' => $data['title'],
            'slug' => $slug,
            'summary' => $data['summary'],
            'content' => $data['content'],
            'cover_image_url' => $data['cover_image_url'],
            'publish_status' => $data['publish_status'],
            'published_at' => $data['published_at'],
        ]);
    
        if ($request->has('categories')) {
            $article->categories()->sync($request->categories);
        }
    
        if ($request->has('tags')) {
            $article->tags()->sync($request->tags);
        }
    
        return redirect()->route('article.index')->with('success', 'Artikel berhasil diperbarui.');
    }
    
    


    public function destroy(Article $article)
{
    $article->categories()->detach();   
    $article->tags()->detach();        

    if ($article->cover_image_url && Storage::exists(str_replace('storage/', 'public/', $article->cover_image_url))) {
        Storage::delete(str_replace('storage/', 'public/', $article->cover_image_url));
    }
    $article->delete();

    return redirect()->route('article.index')->with('success', 'Artikel berhasil dihapus beserta kategori dan tag terkait.');
}

}

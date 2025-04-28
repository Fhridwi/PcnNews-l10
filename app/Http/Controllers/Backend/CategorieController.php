<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Categorie::orderBy('created_at', 'desc')->get();
        return view('backend.categorie.categorie_index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.categorie.categorie_create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Membuat slug otomatis berdasarkan nama
        $slug = Str::slug($request->name);

        Categorie::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('category.index')->with('success', 'Category added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Logic untuk menampilkan kategori, jika diperlukan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Categorie::findOrFail($id);
        $data = Categorie::where('id', '!=', $id)->get();
        return view('backend.categorie.categorie_edit', compact('category', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Categorie::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        // Jika slug kosong, buat slug otomatis berdasarkan nama
        $slug = $request->slug ?: Str::slug($request->name);
        $slug = $this->generateUniqueSlug($slug, $category->id);

        // Update kategori dengan data baru
        $category->update([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'parent_id' => $request->parent_id,
        ]);

        return redirect()->route('category.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $category = Categorie::findOrFail($id);
        $category->delete();

        return redirect()->route('category.index')->with('success', 'Category deleted successfully!');
    }

    /**
     * Generate a unique slug for the category.
     */
    private function generateUniqueSlug($slug, $categoryId)
    {
        $count = 1;
        $originalSlug = $slug;

        while (Categorie::where('slug', $slug)->where('id', '!=', $categoryId)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }

        return $slug;
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $tags = Tag::orderBy('created_at', 'desc')->get();

        return view('backend.tag.tag_index', compact(
            'tags'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
      
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:25|unique:tags,name,'
        ]);
        
        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success', 'Tag berhasil dibuat.');



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
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
        $request->validate([
            'name'  => 'required|max:25|unique:tags,name'
        ]);

        $tags = Tag::findOrFail($id);

        $tags->update([
            'name'  => $request->name,
            'slug'  => Str::slug($request->name)
        ]);

        return redirect()->back()->with('success', 'Berhasil update tag');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tags = Tag::findOrFail($id);

        $tags->delete();

        return redirect()->back()->with('success', 'Tag berhasil dihapus.');

    }
}

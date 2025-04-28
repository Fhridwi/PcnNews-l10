<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;
use Auth;
use Illuminate\Support\Str;
class MediaController extends Controller
{
    public function upload(Request $request)
{
    // Validasi file yang diunggah
    $request->validate([
        'upload' => 'required|file|image|max:5120',  
    ]);

    if ($request->hasFile('upload')) {
        $file = $request->file('upload');

        $filename = time() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs('public/media', $filename);

        $url = Storage::url($path);
        return response()->json([
            'url' => asset($url)
        ]);
    }

    // Jika tidak ada file yang diunggah
    return response()->json(['error' => ['message' => 'Upload gagal.']], 400);
}

}

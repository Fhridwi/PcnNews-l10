<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Profile;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    public function index()
    {
        $profile = Profile::where('user_id', auth()->user()->id)->first();
    
        if (!$profile) {
            return view('backend.profil.profil_create',compact('profile'));  
        }
    
        return view('backend.profil.profil_edit', compact('profile'));  
    }

    public function create()
    {
        return view('backend.profil.profil_create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
            'social_links' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
        ]);

        $user_id = Auth::id();

        $profile = Profile::create([
            'user_id' => $user_id,
            'bio' => $request->input('bio'),
            'phone' => $request->input('phone'),
            'social_links' => $request->input('social_links'),
            'avatar_url' => $this->handleAvatarUpload($request, null)
        ]);

        if ($request->hasFile('avatar')) {
            if ($profile->avatar_url) {
                $this->deleteOldAvatar($profile->avatar_url);
            }

            $profile->avatar_url = $this->handleAvatarUpload($request, $profile->avatar_url);
            $profile->save();
        }

        return redirect()->back()->with('success', 'Profile created successfully!');
    }

    public function edit(string $id)
    {
        $profile = Profile::findOrFail($id);
        return view('backend.profil.profil_edit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        // Validasi input profil
        $request->validate([
            'bio' => 'nullable|string',
            'avatar' => 'nullable|image|max:2048',
            'social_links' => 'nullable|string',
            'phone' => 'nullable|string|max:255',
            'current_password' => 'nullable|string',
            'new_password' => 'nullable|string|min:8|confirmed',
        ]);
    
        // Cari profil berdasarkan ID
        $profile = Profile::findOrFail($id);
        $user = $profile->user; // Ambil user yang terkait dengan profil
    
        // Jika password lama diinput, validasi dan update password
        if ($request->filled('current_password')) {
            if (!\Hash::check($request->input('current_password'), $user->password)) {
                return back()->withErrors(['current_password' => 'Password lama salah.']);
            }
    
            // Update password jika valid
            $user->password = \Hash::make($request->input('new_password'));
            $user->save();
        }
    
        // Update profil (bio, phone, social_links)
        $profile->update([
            'bio' => $request->input('bio'),
            'phone' => $request->input('phone'),
            'social_links' => $request->input('social_links'),
            'avatar_url' => $this->handleAvatarUpload($request, $profile->avatar_url),
        ]);
    
        return redirect()->route('profil.index')->with('success', 'Profil dan password berhasil diperbarui!');
    }
    

    public function destroy(string $id)
    {
        $profile = Profile::findOrFail($id);

        if ($profile->avatar_url) {
            $this->deleteOldAvatar($profile->avatar_url);
        }

        $profile->delete();

        return redirect()->route('backend.profil.index')->with('success', 'Profile deleted successfully!');
    }

    private function handleAvatarUpload(Request $request, $existingAvatar)
    {
        if (!$request->hasFile('avatar')) {
            return $existingAvatar;
        }

        return $request->file('avatar')->store('avatars', 'public');
    }

    private function deleteOldAvatar($avatarPath)
    {
        if ($avatarPath && Storage::exists('public/' . $avatarPath)) {
            Storage::delete('public/' . $avatarPath);
        }
    }

    public function updatePassword(Request $request, $id)
{
    $request->validate([
        'current_password' => 'required|string',
        'new_password' => 'required|string|min:8|confirmed', 
    ]);

    $profile = Profile::findOrFail($id);
    $user = $profile->user; 

    // Validasi password lama
    if (!\Hash::check($request->input('current_password'), $user->password)) {
        return back()->withErrors(['current_password' => 'Password lama salah.']);
    }

    // Jika password lama benar, simpan password baru
    $user->password = \Hash::make($request->input('new_password'));
    $user->save(); // Simpan perubahan password

    return redirect()->route('profil.index')->with('success', 'Password berhasil diperbarui!');
}

}

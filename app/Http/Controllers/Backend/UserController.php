<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $data = User::orderBy('created_at', 'desc')->get();
        $roles = ['admin', 'editor', 'author', 'user'];
        $statuses = ['active', 'inactive', 'suspended'];
        return view('backend.user.user_index', compact('data', 'roles', 'statuses'));
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role' => 'required|in:admin,editor,author,user',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'status' => $request->status,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully.');
    }

    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role' => 'required|in:admin,editor,author,user',
            'status' => 'required|in:active,inactive,suspended',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->status = $request->status;
        $user->save();

        return redirect()->route('user.index')->with('success', 'User updated successfully.');
    }

    public function destroy(string $id)
{
    $user = User::findOrFail($id);

    if($user->id == 102) {
        return redirect()->back()->with('error', 'Maaf, Ada kesalahan yang tidak diketahui.');
    }

    // Menghapus user
    $user->delete();

    return redirect()->route('user.index')->with('success', 'User deleted successfully.');
}

}

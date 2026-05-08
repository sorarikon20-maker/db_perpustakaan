<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Tampilkan daftar semua user yang pernah login / terdaftar.
     */
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('name', 'like', '%' . $search . '%')
                  ->orWhere('email', 'like', '%' . $search . '%')
                  ->orWhere('role', 'like', '%' . $search . '%');
        }

        $users = $query->latest()->paginate(15);
        return view('users.index', compact('users'));
    }

    /**
     * Form tambah user baru.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Simpan user baru ke database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => 'required|in:admin,petugas,siswa',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    /**
     * Form edit user.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update data user.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'role'  => 'required|in:admin,petugas,siswa',
        ]);

        $data = [
            'name'  => $request->name,
            'email' => $request->email,
            'role'  => $request->role,
        ];

        // Hanya update password jika diisi
        if ($request->filled('password')) {
            $request->validate([
                'password' => ['confirmed', Rules\Password::defaults()],
            ]);
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);
        return redirect()->route('users.index')->with('success', 'User berhasil diupdate');
    }

    /**
     * Hapus user.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);

        // Jangan hapus diri sendiri
        if ($user->id === auth()->id()) {
            return redirect()->route('users.index')->with('error', 'Tidak bisa menghapus akun yang sedang digunakan');
        }

        $user->delete();
        return redirect()->route('users.index')->with('success', 'User berhasil dihapus');
    }
}

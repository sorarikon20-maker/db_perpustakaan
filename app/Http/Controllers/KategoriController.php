<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index(Request $request)
    {
        $query = Kategori::withCount('bukus');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_kategori', 'like', '%' . $search . '%')
                  ->orWhere('keterangan', 'like', '%' . $search . '%');
        }

        $kategoris = $query->latest()->paginate(10);
        return view('kategoris.index', compact('kategoris'));
    }

    public function create()
    {
        return view('kategoris.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan'    => 'nullable|string',
        ]);

        Kategori::create($request->only(['nama_kategori', 'keterangan']));
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategoris.show', compact('kategori'));
    }

    public function edit(string $id)
    {
        $kategori = Kategori::findOrFail($id);
        return view('kategoris.edit', compact('kategori'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255',
            'keterangan'    => 'nullable|string',
        ]);

        $kategori = Kategori::findOrFail($id);
        $kategori->update($request->only(['nama_kategori', 'keterangan']));
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil diupdate');
    }

    public function destroy(string $id)
    {
        Kategori::findOrFail($id)->delete();
        return redirect()->route('kategoris.index')->with('success', 'Kategori berhasil dihapus');
    }
}

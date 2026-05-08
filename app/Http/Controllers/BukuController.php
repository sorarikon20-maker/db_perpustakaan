<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        $query = Buku::with('kategori');

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', '%' . $search . '%')
                  ->orWhere('penulis', 'like', '%' . $search . '%')
                  ->orWhere('penerbit', 'like', '%' . $search . '%')
                  ->orWhereHas('kategori', function ($q) use ($search) {
                      $q->where('nama_kategori', 'like', '%' . $search . '%');
                  });
        }

        $bukus = $query->latest()->paginate(10);
        return view('bukus.index', compact('bukus'));
    }

    public function create()
    {
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('bukus.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'nullable|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:2099',
            'kategori_id'  => 'required|exists:kategoris,id',
            'stok'         => 'required|integer|min:0',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rak_nomor'    => 'nullable|string|max:50',
            'deskripsi'    => 'nullable|string|max:5000',
        ]);

        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun_terbit', 'kategori_id', 'stok', 'rak_nomor', 'deskripsi']);
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('bukus', 'public');
        }

        Buku::create($data);
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $buku = Buku::with('kategori')->findOrFail($id);
        return view('bukus.show', compact('buku'));
    }

    public function edit(string $id)
    {
        $buku = Buku::findOrFail($id);
        $kategoris = Kategori::orderBy('nama_kategori')->get();
        return view('bukus.edit', compact('buku', 'kategoris'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'nullable|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900|max:2099',
            'kategori_id'  => 'required|exists:kategoris,id',
            'stok'         => 'required|integer|min:0',
            'cover_image'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'rak_nomor'    => 'nullable|string|max:50',
            'deskripsi'    => 'nullable|string|max:5000',
        ]);

        $buku = Buku::findOrFail($id);
        $data = $request->only(['judul', 'penulis', 'penerbit', 'tahun_terbit', 'kategori_id', 'stok', 'rak_nomor', 'deskripsi']);
        if ($request->hasFile('cover_image')) {
            if ($buku->cover_image) {
                Storage::disk('public')->delete($buku->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image')->store('bukus', 'public');
        }

        $buku->update($data);
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil diupdate');
    }

    public function destroy(string $id)
    {
        Buku::findOrFail($id)->delete();
        return redirect()->route('bukus.index')->with('success', 'Buku berhasil dihapus');
    }
}

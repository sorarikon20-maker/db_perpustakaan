<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        $query = Siswa::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama', 'like', '%' . $search . '%')
                  ->orWhere('nis', 'like', '%' . $search . '%')
                  ->orWhere('kelas', 'like', '%' . $search . '%')
                  ->orWhere('jurusan', 'like', '%' . $search . '%');
        }

        $siswas = $query->latest()->paginate(10);
        return view('siswas.index', compact('siswas'));
    }

    public function create()
    {
        return view('siswas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'nis'     => 'required|string|unique:siswas,nis',
            'kelas'   => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
        ]);

        Siswa::create($request->only(['nama', 'nis', 'kelas', 'jurusan']));
        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswas.show', compact('siswa'));
    }

    public function edit(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('siswas.edit', compact('siswa'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama'    => 'required|string|max:255',
            'nis'     => 'required|string|unique:siswas,nis,' . $id,
            'kelas'   => 'required|string|max:100',
            'jurusan' => 'required|string|max:100',
        ]);

        $siswa = Siswa::findOrFail($id);
        $siswa->update($request->only(['nama', 'nis', 'kelas', 'jurusan']));
        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil diupdate');
    }

    public function destroy(string $id)
    {
        Siswa::findOrFail($id)->delete();
        return redirect()->route('siswas.index')->with('success', 'Siswa berhasil dihapus');
    }
}

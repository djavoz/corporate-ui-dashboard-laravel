<?php

namespace App\Http\Controllers;

use App\Models\Stok;
use App\Models\Kategori;
use Illuminate\Http\Request;

class StokController extends Controller
{
    public function index()
    {
        $stok = Stok::all();
        return view('stok.index', compact('stok'));
    }

    public function create()
    {
        $kategoris = Kategori::all();
        return view('stok.create', compact('kategoris'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'satuan' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'stok' => 'required|string|max:255',
            'jumlah_item' => 'required|integer',
        ]);

        Stok::create([
            'satuan' => $request->satuan,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'jumlah_item' => $request->jumlah_item,
            'created_by' => auth()->id(), // Simpan id user yang membuat
        ]);

        return redirect()->route('stok.index')->with('success', 'Stok berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $stok = Stok::findOrFail($id);
        $kategoris = Kategori::all();
        return view('stok.edit', compact('stok', 'kategoris'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'satuan' => 'required|string|max:255',
            'kategori_id' => 'required|integer',
            'stok' => 'required|string|max:255',
            'jumlah_item' => 'required|integer',
        ]);

        $stok = Stok::findOrFail($id);
        $stok->update([
            'satuan' => $request->satuan,
            'kategori_id' => $request->kategori_id,
            'stok' => $request->stok,
            'jumlah_item' => $request->jumlah_item,
        ]);

        return redirect()->route('stok.index')->with('success', 'Stok berhasil diperbarui!');
    }

    public function show($id)
    {
        $stok = Stok::findOrFail($id);
        return view('stok.show', compact('stok'));
    }

    public function destroy($id)
    {
        $stok = Stok::findOrFail($id);
        $stok->delete();

        return redirect()->route('stok.index')->with('success', 'Stok berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use App\Models\Stok;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    /**
     * Menampilkan daftar laporan.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $laporan = Laporan::with(['stok', 'user'])->get();
        return view('laporan.index', compact('laporan'));
    }

    /**
     * Menampilkan form untuk membuat laporan baru.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $stoks = Stok::all();
        return view('laporan.create', compact('stoks'));
    }

    /**
     * Menyimpan laporan baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'stok_id' => 'required|integer|exists:stok,stok_id',
            'jumlah_masuk' => 'required|integer|min:1',
        ]);

        Laporan::create([
            'stok_id' => $request->stok_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan arus barang masuk berhasil ditambahkan.');
    }

    /**
     * Menampilkan detail laporan.
     *
     * @param  int  $laporan_id
     * @return \Illuminate\Http\Response
     */
    public function show($laporan_id)
    {
        $laporan = Laporan::with(['stok', 'user'])->findOrFail($laporan_id);
        return view('laporan.show', compact('laporan'));
    }

    /**
     * Menampilkan form untuk mengedit laporan.
     *
     * @param  int  $laporan_id
     * @return \Illuminate\Http\Response
     */
    public function edit($laporan_id)
    {
        $laporan = Laporan::findOrFail($laporan_id);
        $stoks = Stok::all();
        return view('laporan.edit', compact('laporan', 'stoks'));
    }

    /**
     * Memperbarui laporan di database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $laporan_id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $laporan_id)
    {
        $request->validate([
            'stok_id' => 'required|integer|exists:stok,stok_id',
            'jumlah_masuk' => 'required|integer|min:1',
        ]);

        $laporan = Laporan::findOrFail($laporan_id);
        $laporan->update([
            'stok_id' => $request->stok_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            // 'created_by' tetap tidak diubah
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan arus barang masuk berhasil diperbarui.');
    }

    /**
     * Menghapus laporan dari database.
     *
     * @param  int  $laporan_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($laporan_id)
    {
        $laporan = Laporan::findOrFail($laporan_id);
        $laporan->delete();

        return redirect()->route('laporan.index')->with('success', 'Laporan arus barang masuk berhasil dihapus.');
    }

    // Barang Masuk
    public function barangMasuk()
    {
        $laporanMasuk = Laporan::with(['stok', 'stok.kategori', 'users'])
            ->where('jumlah_masuk', '>', 0)
            ->get();

        return view('arus-barang-masuk.index', compact('laporanMasuk'));
    }

    // Form Tambah Barang Masuk
    public function createBarangMasuk()
    {
        $stok = Stok::all(); // Ambil semua stok untuk dropdown
        return view('arus-barang-masuk.create', compact('stok'));
    }

    // Simpan Barang Masuk
    public function storeBarangMasuk(Request $request)
    {
        $request->validate([
            'stok_id' => 'required|exists:stok,stok_id',
            'jumlah_masuk' => 'required|numeric|min:1',
        ]);

        Laporan::create([
            'stok_id' => $request->stok_id,
            'jumlah_masuk' => $request->jumlah_masuk,
            'jumlah_keluar' => 0,
            'created_by' => auth()->id(),
        ]);

        $stok = Stok::find($request->stok_id);
        $stok->jumlah_item += $request->jumlah_masuk;
        $stok->save();

        return redirect()->route('barang-masuk.index')->with('success', 'Barang berhasil ditambahkan.');
    }

    // Form Edit Barang Masuk
    public function editBarangMasuk($laporan_id)
    {
        $laporan = Laporan::findOrFail($laporan_id);
        $stok = Stok::all(); // Ambil semua stok untuk dropdown
        return view('arus-barang-masuk.edit', compact('laporan', 'stok'));
    }

    // Update Barang Masuk
    public function updateBarangMasuk(Request $request, $laporan_id)
    {
        $request->validate([
            'stok_id' => 'required|exists:stok,stok_id',
            'jumlah_masuk' => 'required|numeric|min:1',
        ]);

        $laporan = Laporan::findOrFail($laporan_id);
        $stok = Stok::find($request->stok_id);

        // Update jumlah stok
        $stok->jumlah_item += $request->jumlah_masuk - $laporan->jumlah_masuk;
        $stok->save();

        $laporan->update([
            'stok_id' => $request->stok_id,
            'jumlah_masuk' => $request->jumlah_masuk,
        ]);

        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk berhasil diperbarui.');
    }

    public function destroyBarangMasuk($laporan_id)
    {
        $laporan = Laporan::findOrFail($laporan_id);
        $laporan->delete();

        return redirect()->route('barang-masuk.index')->with('success', 'Barang masuk berhasil dihapus.');
    }


    // Barang Keluar
    public function barangKeluar()
    {
        $laporanKeluar = Laporan::with(['stok', 'stok.kategori', 'users'])
            ->where('jumlah_keluar', '>', 0)
            ->get();

        return view('arus-barang-keluar.index', compact('laporanKeluar'));
    }

    // Form Tambah Barang Keluar
    public function createBarangKeluar()
    {
        $stok = Stok::all(); // Ambil semua stok untuk dropdown
        return view('arus-barang-keluar.create', compact('stok'));
    }

    // Simpan Barang Keluar
    public function storeBarangKeluar(Request $request)
    {
        
        $request->validate([
            'stok_id' => 'required|exists:stok,stok_id',
            'jumlah_keluar' => 'required|numeric|min:1',
        ]);
        
        $stok = Stok::find($request->stok_id);
        
        if ($stok->jumlah_item < $request->jumlah_keluar) {
            return back()->withErrors(['jumlah_keluar' => 'Jumlah barang keluar melebihi stok tersedia.']);
        }

        Laporan::create([
            'stok_id' => $request->stok_id,
            'jumlah_keluar' => $request->jumlah_keluar,
            'jumlah_masuk' => 0,
            'created_by' => auth()->id(),
        ]);

        $stok->jumlah_item = intval($stok->jumlah_item) - intval($request->jumlah_keluar);
        $stok->save();

        return redirect()->route('barang-keluar.index')->with('success', 'Barang berhasil dikeluarkan.');
    }

    // Form Edit Barang Keluar
    public function editBarangKeluar($laporan_id)
    {
        $laporan = Laporan::findOrFail($laporan_id);
        $stok = Stok::all(); // Ambil semua stok untuk dropdown
        return view('arus-barang-keluar.edit', compact('laporan', 'stok'));
    }

    // Update Barang Keluar
    public function updateBarangKeluar(Request $request, $laporan_id)
    {
        $request->validate([
            'stok_id' => 'required|exists:stok,stok_id',
            'jumlah_keluar' => 'required|numeric|min:1',
        ]);

        $laporan = Laporan::findOrFail($laporan_id);
        $stok = Stok::find($request->stok_id);

        if ($stok->jumlah_item + $laporan->jumlah_keluar < $request->jumlah_keluar) {
            return back()->withErrors(['jumlah_keluar' => 'Jumlah barang keluar melebihi stok tersedia.']);
        }

        $stok->jumlah_item += $laporan->jumlah_keluar - $request->jumlah_keluar;
        $stok->save();

        $laporan->update([
            'stok_id' => $request->stok_id,
            'jumlah_keluar' => $request->jumlah_keluar,
        ]);

        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar berhasil diperbarui.');
    }

    public function destroyBarangKeluar($laporan_id)
    {
        $laporan = Laporan::findOrFail($laporan_id);
        $laporan->delete();

        return redirect()->route('barang-keluar.index')->with('success', 'Barang keluar berhasil dihapus.');
    }



}

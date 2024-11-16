<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <h6 class="font-weight-semibold text-lg mb-0">Tambah Stok</h6>
            <form action="{{ route('stok.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="kategori_id" class="form-label">Kategori</label>
                    <select class="form-control" id="kategori_id" name="kategori_id" required>
                        @foreach ($kategoris as $kategori)
                            <option value="{{ $kategori->kategori_id }}">{{ $kategori->kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="stok" class="form-label">Stok</label>
                    <input type="text" class="form-control" id="stok" name="stok" required>
                </div>
                <div class="mb-3">
                    <label for="jumlah_item" class="form-label">Jumlah Item</label>
                    <input type="number" class="form-control" id="jumlah_item" name="jumlah_item" required>
                </div>
                <div class="mb-3">
                    <label for="satuan" class="form-label">Satuan</label>
                    <input type="text" class="form-control" id="satuan" name="satuan" required>
                </div>
                <button type="submit" class="btn btn-sm btn-dark">Simpan</button>
            </form>
        </div>
    </main>
</x-app-layout>

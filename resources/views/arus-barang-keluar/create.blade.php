<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header">
                            <h6 class="font-weight-semibold text-lg">Tambah Barang Keluar</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('barang-keluar.store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="stok_id" class="form-label">Pilih Barang</label>
                                    <select name="stok_id" id="stok_id" class="form-select">
                                        <option value="">-- Pilih Barang --</option>
                                        @foreach ($stok as $item)
                                            <option value="{{ $item->stok_id }}">{{ $item->stok }} ({{ $item->kategori->kategori }})</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_keluar" class="form-label">Jumlah Keluar</label>
                                    <input type="number" name="jumlah_keluar" id="jumlah_keluar" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

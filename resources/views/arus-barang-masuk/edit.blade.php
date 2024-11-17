<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header">
                            <h6 class="font-weight-semibold text-lg">Edit Barang Masuk</h6>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('barang-masuk.update', $laporan->laporan_id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="stok_id" class="form-label">Pilih Barang</label>
                                    <select name="stok_id" id="stok_id" class="form-select">
                                        @foreach ($stok as $item)
                                            <option value="{{ $item->stok_id }}" @if ($laporan->stok_id == $item->stok_id) selected @endif>
                                                {{ $item->stok }} ({{ $item->kategori->kategori }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="jumlah_masuk" class="form-label">Jumlah Masuk</label>
                                    <input type="number" name="jumlah_masuk" id="jumlah_masuk" class="form-control" value="{{ old('jumlah_masuk', $laporan->jumlah_masuk) }}">
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

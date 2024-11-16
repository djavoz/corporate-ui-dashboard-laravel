<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-12">
                    <div class="card border shadow-xs mb-4">
                        <div class="card-header border-bottom pb-0">
                            <div class="d-sm-flex align-items-center">
                                <div>
                                    <h6 class="font-weight-semibold text-lg mb-0">Detail Stok</h6>
                                    <p class="text-sm">Informasi tentang stok ini</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('stok.index') }}" class="btn btn-sm btn-secondary">
                                        Kembali ke Daftar
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <tbody>
                                        <tr>
                                            <th class="text-secondary opacity-7">Kategori ID</th>
                                            <td>{{ $stok->kategori->kategori }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-secondary opacity-7">Nama Stok</th>
                                            <td>{{ $stok->stok }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-secondary opacity-7">Jumlah Item</th>
                                            <td>{{ $stok->jumlah_item }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-secondary opacity-7">Satuan</th>
                                            <td>{{ $stok->satuan }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-secondary opacity-7">Created By</th>
                                            <td>{{ $stok->user->name }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <x-app.footer />
        </div>
    </main>
</x-app-layout>

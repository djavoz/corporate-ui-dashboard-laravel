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
                                    <h6 class="font-weight-semibold text-lg mb-0">Detail Kategori</h6>
                                    <p class="text-sm">Informasi tentang kategori ini</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('kategori.index') }}" class="btn btn-sm btn-secondary">
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
                                            <td>{{ $kategori->kategori_id }}</td>
                                        </tr>
                                        <tr>
                                            <th class="text-secondary opacity-7">Nama Kategori</th>
                                            <td>{{ $kategori->kategori }}</td>
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

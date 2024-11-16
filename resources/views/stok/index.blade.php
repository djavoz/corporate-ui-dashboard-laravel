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
                                    <h6 class="font-weight-semibold text-lg mb-0">Stok List</h6>
                                    <p class="text-sm">Daftar semua stok</p>
                                </div>
                                <div class="ms-auto d-flex">
                                    <a href="{{ route('stok.create') }}" class="btn btn-sm btn-dark btn-icon d-flex align-items-center me-2">
                                        <span class="btn-inner--text">Tambah Stok</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body px-0 py-0">
                            <div class="table-responsive p-0">
                                <table class="table align-items-center mb-0">
                                    <thead class="bg-gray-100">
                                        <tr>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 w-10">Nomor</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 w-40 ps-2">Stok</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 w-20">Satuan</th>
                                            <th class="text-center text-secondary text-xs font-weight-semibold opacity-7 w-20">Jumlah Item</th>
                                            <th class="text-center text-secondary opacity-7 w-40">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($stok as $index => $item)
                                            <tr>
                                                <td class="text-center">{{ $index + 1 }}</td>
                                                <td class="text-center">
                                                    <p class="text-sm text-dark font-weight-semibold mb-0">{{ $item->stok }}</p>
                                                </td>
                                                <td class="text-center">{{ $item->satuan }}</td>
                                                <td class="text-center">{{ $item->jumlah_item }}</td>
                                                <td class="text-center">
                                                    <!-- Icon Detail (Mata) -->
                                                    <a href="{{ route('stok.show', $item->stok_id) }}" class="btn btn-sm text-info" title="Detail">
                                                        <i class="bx bx-show fs-4"></i> <!-- fs-4 untuk ukuran ikon lebih besar -->
                                                    </a>
                                                  
                                                    <!-- Icon Edit -->
                                                    <a href="{{ route('stok.edit', $item->stok_id) }}" class="btn btn-sm text-primary" title="Edit">
                                                        <i class="bx bx-edit fs-4"></i> <!-- fs-4 untuk ukuran ikon lebih besar -->
                                                    </a>
                                                  
                                                    <!-- Icon Hapus (Trash) -->
                                                    <form action="{{ route('stok.destroy', $item->stok_id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-sm text-danger" type="submit" title="Hapus">
                                                            <i class="bx bx-trash fs-4"></i> <!-- fs-4 untuk ukuran ikon lebih besar -->
                                                        </button>
                                                    </form>
                                                </td>                                                                                
                                            </tr>
                                        @endforeach
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

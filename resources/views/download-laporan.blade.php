<x-app-layout>
    <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg">
        <x-app.navbar />
        <div class="container-fluid py-4 px-5">
            <div class="row">
                <div class="col-md-12 mb-4">
                    <!-- Form untuk memilih rentang tanggal -->
                    <form action="{{ route('laporan.download') }}" method="GET">
                        <div class="d-flex">
                            <div class="form-group me-2">
                                <label for="start_date" class="form-label">Tanggal Mulai</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            <div class="form-group me-2">
                                <label for="end_date" class="form-label">Tanggal Akhir</label>
                                <input type="date" id="end_date" name="end_date" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary align-self-end">
                                <i class="bx bx-download"></i> Download Laporan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>
</x-app-layout>

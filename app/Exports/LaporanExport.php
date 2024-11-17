<?php

namespace App\Exports;

use App\Models\Laporan;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LaporanExport implements FromCollection, WithHeadings
{
    protected $start_date;
    protected $end_date;

    public function __construct($start_date, $end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    /**
     * Mengambil data laporan berdasarkan rentang tanggal
     */
    public function collection()
    {
        return Laporan::with(['stok', 'stok.kategori', 'users'])
            ->whereBetween('created_at', [$this->start_date, $this->end_date])
            ->get()
            ->map(function ($laporan) {
                return [
                    'Stok' => $laporan->stok->stok,
                    'Kategori' => $laporan->stok->kategori->kategori,
                    'Jumlah Masuk' => $laporan->jumlah_masuk,
                    'Jumlah Keluar' => $laporan->jumlah_keluar,
                    'Tanggal' => $laporan->created_at->format('d/m/Y'),
                    'Dibuat Oleh' => $laporan->users->name,
                ];
            });
    }

    /**
     * Menambahkan heading kolom
     */
    public function headings(): array
    {
        return [
            'Nama Stok',
            'Kategori',
            'Jumlah Masuk',
            'Jumlah Keluar',
            'Tanggal',
            'Dibuat Oleh'
        ];
    }
}

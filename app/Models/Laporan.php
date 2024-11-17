<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory;

    protected $table = 'laporan';
    protected $primaryKey = 'laporan_id';
    public $timestamps = true;

    protected $fillable = [
        'stok_id',
        'jumlah_masuk',
        'jumlah_keluar',
        'created_by',
    ];

    // Relasi dengan Stok
    public function stok()
    {
        return $this->belongsTo(Stok::class, 'stok_id', 'stok_id');
    }

    // Relasi dengan User
    public function users()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}

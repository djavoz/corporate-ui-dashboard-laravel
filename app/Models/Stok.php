<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stok extends Model
{
    use HasFactory;

    protected $table = 'stok'; // Nama tabel
    protected $primaryKey = 'stok_id'; // Primary key
    protected $fillable = [
        'satuan', 
        'kategori_id', 
        'stok', 
        'jumlah_item', 
        'created_by'
    ];

    // Relasi dengan tabel kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id', 'kategori_id');
    }
    
    // Relasi dengan tabel users
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

}

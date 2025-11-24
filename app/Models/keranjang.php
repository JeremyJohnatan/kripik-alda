<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    use HasFactory;

    protected $table = 'keranjang';
    protected $primaryKey = 'ID_Keranjang';

    public $incrementing = true;      // WAJIB diubah
    protected $keyType = 'int';       // WAJIB diubah

    protected $fillable = [
        'ID_User',
        'ID_Produk',
        'Jumlah',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_User');
    }

    // Relasi ke Produk
    public function produk()
    {
        return $this->belongsTo(Product::class, 'ID_Produk');
    }
}

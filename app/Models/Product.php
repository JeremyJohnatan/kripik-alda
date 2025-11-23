<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Nama tabel tepat seperti di database
    protected $table = 'product';

    // Primary key
    protected $primaryKey = 'ID_Produk';

    // Primary key auto increment
    public $incrementing = true;

    // Primary key tipe integer
    protected $keyType = 'int';

    // Karena tabel punya created_at dan updated_at
    public $timestamps = true;

    // Mass assignment fields
    protected $fillable = [
        'Nama_Produk',
        'Deskripsi',
        'Harga',
        'Stok',
        'Item_Produk',
    ];
}

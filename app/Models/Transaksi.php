<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksi'; // Nama tabel
    protected $primaryKey = 'ID_Transaksi'; // Menyebutkan kolom primary key yang benar
    public $incrementing = false; // Jika ID_Transaksi bukan auto-increment
    protected $keyType = 'string'; // Jika tipe primary key bukan integer (misal UUID atau string)

    protected $fillable = [
        'ID_User', 'Tanggal', 'Status_Pembayaran',
    ];

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'ID_User');
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('product', function (Blueprint $table) {
            $table->id('ID_Produk');  
            $table->string('Nama_Produk');
            $table->text('Deskripsi');
            $table->decimal('Harga', 10, 2);
            $table->integer('Stok');
            $table->string('Item_Produk');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('product');
    }
};

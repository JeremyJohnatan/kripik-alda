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
        Schema::create('detail_transaksi', function (Blueprint $table) {
            $table->id('ID_Detail');  
            $table->unsignedBigInteger('ID_Transaksi');  
            $table->unsignedBigInteger('ID_Produk');  
            $table->integer('Jumlah');
            $table->decimal('Subtotal', 10, 2);
            $table->timestamps();
            $table->foreign('ID_Transaksi')->references('ID_Transaksi')->on('transaksi')->onDelete('cascade');
            $table->foreign('ID_Produk')->references('ID_Produk')->on('product')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('detail_transaksi');
    }
};

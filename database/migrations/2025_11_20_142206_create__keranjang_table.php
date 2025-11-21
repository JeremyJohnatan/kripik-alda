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
        Schema::create('_keranjang', function (Blueprint $table) {
            $table->id('ID_Keranjang');  
            $table->unsignedBigInteger('ID_User');  
            $table->unsignedBigInteger('ID_Produk'); 
            $table->integer('Jumlah');
            $table->timestamps();
            $table->foreign('ID_User')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('ID_Produk')->references('ID_Produk')->on('product')->onDelete('cascade');
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('_keranjang');
    }
};

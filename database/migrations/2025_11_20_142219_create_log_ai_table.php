<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up(): void
    {
        Schema::create('log_ai', function (Blueprint $table) {
            $table->id('ID_Log');  
            $table->unsignedBigInteger('ID_User');  
            $table->dateTime('Tanggal_Proses');
            $table->string('Type_Proses');
            $table->text('Hasil_Proses');
            $table->text('Data_Input');
            $table->timestamps();

            $table->foreign('ID_User')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('log_ai');
    }
};

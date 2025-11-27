<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('surat_keluar', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_urut', 50);
            $table->string('nomor_berkas', 50);
            $table->text('alamat_penerima')->nullable();
            $table->date('tanggal_surat');
            $table->text('perihal');
            $table->string('nomor_petunjuk', 50)->nullable();
            $table->string('nomor_paket', 50)->nullable();
            $table->string('file_path')->nullable();


            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('surat_keluar');
    }
};
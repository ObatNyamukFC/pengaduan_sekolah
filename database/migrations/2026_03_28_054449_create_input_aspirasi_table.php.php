<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('input_aspirasi', function (Blueprint $table) {
            $table->increments('id_pelaporan');
            $table->integer('nis')->unsigned();
            $table->unsignedInteger('id_kategori');
            $table->string('lokasi', 100)->nullable();
            $table->text('keterangan')->nullable();
            $table->tinyInteger('is_anonim')->default(0);
            $table->timestamp('created_at')->useCurrent();

            $table->foreign('nis')->references('nis')->on('siswa')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('input_aspirasi');
    }
};
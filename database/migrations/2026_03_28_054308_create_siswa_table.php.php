<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('siswa', function (Blueprint $table) {
            $table->integer('nis')->unsigned()->primary();
            $table->string('kelas', 10);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('siswa');
    }
};
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aspirasi', function (Blueprint $table) {
            $table->increments('id_aspirasi');
            $table->unsignedInteger('id_pelaporan');
            $table->enum('status', ['Menunggu', 'Proses', 'Selesai'])->default('Menunggu');
            $table->text('feedback')->nullable();
            $table->timestamp('updated_at')->nullable()->useCurrentOnUpdate();

            $table->foreign('id_pelaporan')->references('id_pelaporan')->on('input_aspirasi')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aspirasi');
    }
};
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
        Schema::create('data_utamas', function (Blueprint $table) {
            $table->id();
            $table->string('koordinat');
            $table->string('kode_desa');
            $table->string('tahun_pembentukan');
            $table->string('dasar_hukum');
            $table->string('tipologi');
            $table->string('klasifikasi');
            $table->string('kategori');
            $table->string('luas_wilayah');
            $table->string('batas_utara');
            $table->string('batas_selatan');
            $table->string('batas_timur');
            $table->string('batas_barat');
            $table->text('link_gmaps');
            $table->string('gambar_struktur');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_utamas');
    }
};

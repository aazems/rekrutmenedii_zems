<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLokasiJenisKerjaToRekrutmenTable extends Migration
{
    public function up()
    {
        Schema::table('rekrutmen', function (Blueprint $table) {
            $table->string('lokasi')->nullable(); // Kolom lokasi
            $table->string('jenis_kerja')->nullable(); // Kolom jenis kerja
        });
    }

    public function down()
    {
        Schema::table('rekrutmen', function (Blueprint $table) {
            $table->dropColumn(['lokasi', 'jenis_kerja']); // Hapus kolom saat rollback
        });
    }
}

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('applyments', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_apply');
            $table->string('nik', 20);
            $table->string('nama');
            $table->text('alamat_ktp');
            $table->text('alamat_domisili');
            $table->string('phone', 15);
            $table->string('email');
            $table->string('file_ktp');
            $table->string('file_cv');
            $table->string('file_lamaran');
            $table->text('deskripsi_lamaran');
            $table->string('posisi_apply');
            $table->string('status_apply')->default('Pending');
            $table->dateTime('created_date')->useCurrent();
            $table->string('created_by')->default('System');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applyments');
    }
};

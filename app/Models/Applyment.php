<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applyment extends Model
{
    use HasFactory;

    protected $table = 'applyments'; // Nama tabel

    protected $fillable = [
        'tanggal_apply',
        'nik',
        'nama',
        'alamat_ktp',
        'alamat_domisili',
        'phone',
        'email',
        'file_ktp',
        'file_cv',
        'file_lamaran',
        'deskripsi_lamaran',
        'posisi_apply',
        'status_apply',
        'created_date',
        'created_by',
    ];

    public $timestamps = false; // Tidak menggunakan timestamps bawaan Laravel

    public function rekrut()
    {
        return $this->belongsTo(Rekrut::class, 'posisi_apply', 'id');
    }

}

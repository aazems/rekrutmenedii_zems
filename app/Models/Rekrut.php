<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekrut extends Model
{
    use HasFactory;

    protected $table = 'rekrutmen';

    protected $fillable = [
        'title',
        'title_en',
        'subtitle',
        'subtitle_en',
        'content',
        'content_en',
        'image',
        'is_approved',
        'is_share',
        'inactive_at',
        'inactive_by',
        'created_by',
        'updated_by',
        'redirect_link',
        'slug',
        'lokasi',
        'jenis_kerja',
        'linked_url',
        'jobstreet_url',
        'glint_url',
        
    ];

    public function applyments()
    {
        return $this->hasMany(Applyment::class, 'posisi_apply', 'id');
    }
}

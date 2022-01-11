<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_lampiran',
        'rekap_tugas_id'
    ];

    public function rekap_tugas()
    {
        return $this->belongsTo(RekapTugas::class, 'rekap_tugas_id');
    }
}

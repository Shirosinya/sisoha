<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekap extends Model
{
    use HasFactory;

    protected $fillable = [
        'uraian_tugas',
        'mulai',
        'selesai',
        'keterangan',
    ];

    protected $casts = [
        'mulai' => 'date:hh:mm',
        'selesai' => 'date:hh:mm'
    ];

    public function satpam()
    {
        return $this->belongsTo(Satpam::class);
    }
}

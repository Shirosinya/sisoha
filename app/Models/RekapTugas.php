<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RekapTugas extends Model
{
    use HasFactory;

    public $table = "rekap_tugass";

    protected $fillable = [
        'uraian_tugas',
        'mulai',
        'selesai',
        'keterangan',
        'satpam_id',
    ];

    public function satpam(){
        return $this->belongsTo(Satpam::class);
    }

    public function lampirans(){
        return $this->hasMany(Lampiran::class);
    }
}

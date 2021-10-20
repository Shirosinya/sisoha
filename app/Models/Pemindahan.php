<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemindahan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemindahan',
        'gudang',
        'tujuan',
        'armada',
        'keterangan',
        'regu_id',
        'zona_id',
        
    ];

    public function zona(){
        return $this->belongsTo(Zona::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'keterangan',
        'zona_id',
        
    ];

    public function zona(){
        return $this->belongsTo(Zona::class);
    }
}

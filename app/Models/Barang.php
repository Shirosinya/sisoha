<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_barang',
        'jumlah',
        'zona_id',
        
    ];

    public function zona(){
        return $this->belongsTo(Zona::class);
    }

    public function inventaris(){
        return $this->belongsTo(Inventaris::class);
    }

}

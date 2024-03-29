<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pamswakarsa extends Model
{
    use HasFactory;

    protected $fillable = [
        'wilayah',
        'nama_petugas',
        'po',
        'pb',
        'ok',
        'regu_id',
        'zona_id',
    ];

    public function zona(){
        return $this->belongsTo(Zona::class);
    }
}

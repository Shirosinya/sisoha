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
        'pe',
        'pb',
        'ok',
        'regu_id',
    ];

    public function zona(){
        return $this->belongsTo(Zona::class);
    }
}

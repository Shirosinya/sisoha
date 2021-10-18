<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailZona extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'zona_id',
    ];

    public function detail_zona(){
        return $this->belongsTo(Zona::class);
    }
}

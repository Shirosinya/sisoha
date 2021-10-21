<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventaris extends Model
{
    use HasFactory;

    public $table = 'inventariss';

    protected $fillable = [
        'kondisi',
        'keterangan',
        'barang_id',
        'regu_id',
        'zona_id',
        
    ];

    public function barang(){
        return $this->belongsTo(Barang::class);
    }
}

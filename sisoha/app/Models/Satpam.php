<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Satpam extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'nik',
        'jabatan',
        'status',
        'regu_id',
        'zona_id',
    ];

    public function regu()
    {
        return $this->belongsTo(Regu::class);
    }

    public function rekaps()
    {
        return $this->hasMany(Rekap::class);
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    // public function pos()
    // {
    //     return $this->belongsTo(Pos::class);
    // }
}

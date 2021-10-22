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
        'pos_1',
        'pos_2',
        'pos_3',
        'pos_4',
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

    public function pos_satpams()
    {
        return $this->hasMany(PosSatpam::class);
    }

    public function rekap_tugass()
    {
        return $this->hasMany(RekapTugas::class);
    }

    // public function pos()
    // {
    //     return $this->belongsTo(Pos::class);
    // }
}

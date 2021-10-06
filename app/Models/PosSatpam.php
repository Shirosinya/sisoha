<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PosSatpam extends Model
{
    use HasFactory;

    protected $fillable = [
        'jadwal_shift',
        'pos_id',
        'satpam_id',
    ];

    public function satpam()
    {
        return $this->belongsTo(Satpam::class);
    }

    public function pos()
    {
        return $this->belongsTo(Pos::class);
    }
}

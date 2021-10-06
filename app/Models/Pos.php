<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{
    use HasFactory;

    public $table = "poss";

    protected $fillable=[
        'nama',
    ];

    // public function satpam()
    // {
    //     return $this->hasMany(Satpam::class);
    // }

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }

    public function pos_satpam()
    {
        return $this->hasMany(PosSatpam::class);
    }
}

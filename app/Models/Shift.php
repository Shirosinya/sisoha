<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'mulai',
        'selesai',
    ];

    protected $casts = [
        'mulai' => 'date:hh:mm',
        'selesai' => 'date:hh:mm'
    ];

    public function detail_shifts()
    {
        return $this->hasMany(DetailShift::class);
    }

    public function regu()
    {
        return $this->belongsTo(Regu::class);
    }
}

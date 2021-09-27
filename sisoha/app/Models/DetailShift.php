<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'waktu_awal',
        'waktu_akhir'
    ];

    protected $casts = [
        'waktu_awal' => 'date:hh:mm',
        'waktu_akhir' => 'date:hh:mm'
    ];


    public function shift(){
        return $this->belongsTo(Shift::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Regu extends Model
{
    use HasFactory;

    protected $fillable=[
        'nama',
        'shift_id',
    ];

    public function satpams()
    {
        return $this->hasMany(Satpam::class);
    }

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    public function tugas()
    {
        return $this->belongsTo(Tugas::class);
    }
}

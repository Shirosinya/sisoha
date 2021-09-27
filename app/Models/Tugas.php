<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    public $table = 'tugass';

    protected $fillable = [
        'uraian_tugas',
        'keterangan',
    ];

    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }
}

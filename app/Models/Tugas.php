<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tugas extends Model
{
    use HasFactory;

    public $table = 'tugass';

    protected $fillable = [
        'pukul',
        'uraian_tugas',
        'keterangan',
        'regu_id',
    ];

    public function shift()
    {
        return $this->belongsTo(Regu::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zona extends Model
{
    use HasFactory;

    // protected $guarded = ['id'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function satpams()
    {
        return $this->hasMany(Satpam::class);
    }

    public function produksis()
    {
        return $this->hasMany(Produksi::class);
    }

    public function pemindahans()
    {
        return $this->hasMany(Pemindahan::class);
    }

    public function giat_armadas()
    {
        return $this->hasMany(GiatArmada::class);
    }

    public function barangs()
    {
        return $this->hasMany(Barang::class);
    }
}

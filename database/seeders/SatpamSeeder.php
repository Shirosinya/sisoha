<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satpam;

class SatpamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satpams = [
            ['Fery Arisandi', 'K020760', 'kajaga', 'bekerja','1', '1'],
            ['Frediyan FR', 'K200678', 'wakajaga', 'bekerja','1', '1'],
            ['Alan Kartanu', 'K201599', 'penjaga', 'bekerja','1', '2'],
            ['Ach. Julianto', 'Y21301124', 'penjaga', 'bekerja','1', '2'],
            ['Husai Wibisono', 'K020774', 'penjaga', 'bekerja','1', '2'],
            ['Setyo Budiono', 'K200884', 'kajaga', 'bekerja','2', '1'],
            ['Machrus', 'K200779', 'wakajaga', 'bekerja','2', '3'],
            ['Arif Fatchur R', 'Y21301123', 'penjaga', 'bekerja','2', '3'],
            ['Supadiono', 'K200304', 'penjaga', 'bekerja','2', '3'],
      ];
        foreach ($satpams as $key => $value) {
            $satpam = Satpam::updateOrCreate([
                'id'    => $key+1,
            ], [
                'nama' => $value[0],
                'nik' => $value[1],
                'jabatan' => $value[2],
                'status' => $value[3],
                'regu_id' => $value[4],
                'zona_id' => $value[5],
            ]);
        }
    }
}

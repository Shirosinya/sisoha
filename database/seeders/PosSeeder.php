<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pos;

class PosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $poss = [
            ['RIK', 'lorem ipsum', '1'],
            ['TD I', 'lorem ipsum', '1'],
            ['TD II', 'lorem ipsum', '1'],
            ['PGU', 'lorem ipsum', '1'],
            ['II', 'lorem ipsum', '1'],
            ['Pos6', 'lorem ipsum', '2'],
            ['Pos7', 'lorem ipsum', '2'],
            ['Pos8', 'lorem ipsum', '2'],
            ['Pos9', 'lorem ipsum', '2'],
            ['Pos10', 'lorem ipsum', '2'],
    ];
        foreach ($poss as $key => $value) {
            $pos = Pos::updateOrCreate([
                'id'    => $key+1,
            ], [
                'nama_pos' => $value[0],
                'keterangan' => $value[1],
                'zona_id' => $value[2],
            ]);
        }
    }
}

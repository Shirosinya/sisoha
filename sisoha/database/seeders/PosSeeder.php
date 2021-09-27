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
            ['Pos1', 'lorem ipsum', '1'],
            ['Pos2', 'lorem ipsum', '1'],
            ['Pos3', 'lorem ipsum', '1'],
            ['Pos4', 'lorem ipsum', '1'],
            ['Pos5', 'lorem ipsum', '1'],
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

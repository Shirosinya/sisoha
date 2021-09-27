<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailShift;

class DetailShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail_shifts = [
            ['a', '06:00', '08:00', '1'],
            ['b', '08:00', '10:00', '1'],
            ['c', '10:00', '12:00', '1'],
            ['d', '12:00', '14:00', '1'],
            ['a', '14:00', '16:00', '2'],
            ['b', '16:00', '18:00', '2'],
            ['c', '18:00', '20:00', '2'],
            ['d', '20:00', '22:00', '2'],
            ['a', '22:00', '24:00', '3'],
            ['b', '24:00', '02:00', '3'],
            ['c', '02:00', '04:00', '3'],
            ['d', '04:00', '06:00', '3'],
    ];
        foreach ($detail_shifts as $key => $value) {
            $detail_shift = DetailShift::updateOrCreate([
                'id'    => $key+1,
            ], [
                'nama' => $value[0],
                'waktu_awal' => $value[1],
                'waktu_akhir' => $value[2],
                'shift_id' => $value[3],
            ]);
        }
    }
}

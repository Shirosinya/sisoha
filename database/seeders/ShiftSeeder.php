<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shift;

class ShiftSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shifts = [
            ['Shift 1', '06:00', '14:00'],
            ['Shift 2', '14:00', '22:00'],
            ['Shift 3', '22:00', '06:00'],
            ['OFF', null, null],
        ];
            foreach ($shifts as $key => $value) {
                $shift = Shift::updateOrCreate([
                    'id'    => $key+1,
                ], [
                    'nama' => $value[0],
                    'mulai' => $value[1],
                    'selesai' => $value[2],
                ]);
            }
    }
}

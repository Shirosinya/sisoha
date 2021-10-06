<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PosSatpam;

class PosSatpamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pos_satpams = [
            ['2021-10-04 14:00:00', '3', '2'],
            ['2021-10-04 16:00:00', '3', '5'],
            ['2021-10-04 18:00:00', '3', '3'],
            ['2021-10-04 20:00:00', '3', '1'],

            ['2021-10-04 14:00:00', '4', '3'],
            ['2021-10-04 16:00:00', '4', '2'],
            ['2021-10-04 18:00:00', '4', '5'],
            ['2021-10-04 20:00:00', '4', '1'],
        
      ];
        foreach ($pos_satpams as $key => $value) {
            $pos_satpam = PosSatpam::updateOrCreate([
                'id'    => $key+1,
            ], [
                'jadwal_shift' => $value[0],
                'satpam_id' => $value[1],
                'pos_id' => $value[2],
            ]);
        }
    }
}

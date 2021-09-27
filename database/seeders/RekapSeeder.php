<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Rekap;

class RekapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rekaps = [
            ['Menerima pergantian shift dari Regu X', '14:05', null, '1'],
            ['Patroli 1', '16:23', '15:33', '1'],
            ['Patroli yang ke 2', '18:00', '19:02', '1'],
            ['Patroli ke 3', '20:00', '20:55', '2'],
            ['Penyerahan tugas shift ke Regu X', '22:00', null, '2'],
        ];
        foreach ($rekaps as $key => $value) {
            $rekap = Rekap::updateOrCreate([
                'id'    => $key+1,
            ], [
                'uraian_tugas' => $value[0],
                'mulai' => $value[1],
                'selesai' => $value[2],
                'satpam_id' => $value[3],
            ]);
        }
    }
}

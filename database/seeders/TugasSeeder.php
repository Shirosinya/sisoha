<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Tugas;

class TugasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tugass = [
            ['14:00','Ini uraian tugas penerimaan shift 2 dari shift 1', '2'],
            ['06:23', 'Ini uraian tugas penerimaan shift 1 dari shift 3', '1'],
            ['20:29', 'Ini uraian tugas penerimaan shift 3 dari shift 2', '3'],
        ];
        foreach ($tugass as $key => $value) {
            $tugas = Tugas::updateOrCreate([
                'id'    => $key+1,
            ], [
                'pukul' => $value[0],
                'uraian_tugas' => $value[1],
                'regu_id' => $value[2],
            ]);
        }
    }
}

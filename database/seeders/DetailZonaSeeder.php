<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DetailZona;

class DetailZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $detail_zonas = [
            ['Produksi I', '1'],
            ['Pemeliharaan I', '1'],
            ['Produksi II', '2'],
            ['Pemeliharaan II', '2'],
        ];
        foreach ($detail_zonas as $key => $value) {
            $detail_zona = DetailZona::updateOrCreate([
                'id'    => $key+1,
            ], [
                'nama' => $value[0],
                'zona_id' => $value[1],
            ]);
        }
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Zona;

class ZonaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $zonas = [
            ['Zona 1'],
            ['Zona 2'],
            ['Zona 3'],
            ['Zona 4'],
            ['Zona 5'],
            ['Zona Kawasan'],
            ['Zona TUKS'],
            ['Pamtup'],
    ];
        foreach ($zonas as $key => $value) {
            $zona = Zona::updateOrCreate([
                'id'    => $key+1,
            ], [
                'nama' => $value[0],
            ]);
        }
    }
}

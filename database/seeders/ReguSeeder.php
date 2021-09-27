<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Regu;

class ReguSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $regus = [
            ['Regu A'],
            ['Regu B'],
            ['Regu C'],
            ['Regu D'],
        ];
        foreach ($regus as $key => $value) {
            $regu = Regu::updateOrCreate([
                'id'    => $key+1,
            ], [
                'nama' => $value[0],
            ]);
        }
    }
}

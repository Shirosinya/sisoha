<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(ZonaSeeder::class);
        $this->call(SatpamSeeder::class);
        $this->call(PosSeeder::class);
        $this->call(DetailShiftSeeder::class);
        $this->call(ShiftSeeder::class);
        $this->call(TugasSeeder::class);
        $this->call(ReguSeeder::class);
        $this->call(RekapSeeder::class);
    }
}

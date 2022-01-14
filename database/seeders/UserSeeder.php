<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $add = 21;
        $users = [
            ['zona1', 'kajaga','1'],
            ['zona2', 'kajaga','2'],
            ['zona3', 'kajaga','3'],
            ['zona4', 'kajaga','4'],
            ['zona5', 'kajaga','5'],
            ['zonakawasan', 'kajaga','6'],
            ['zonatuks', 'kajaga','7'],
            ['pamtup', 'kajaga','8'],
    ];
        foreach ($users as $key => $value) {
            $user = User::updateOrCreate([
                'id'    => $key+1,
            ], [
                'nama' => $value[0],
                'password' => bcrypt('ijinmasuk'.strval($add)),
                'level_user' => $value[1],
                'remember_token' => Str::random(10),
                'zona_id' => $value[2],
            ]);
            $add = $add + 1;
        }
    }
}

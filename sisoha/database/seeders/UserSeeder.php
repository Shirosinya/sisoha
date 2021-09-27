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
        $users = [
            ['admin', 'admin@gmail.com', 'admin', null],
            ['supervisor', 'supervisor@gmail.com', 'supervisor','1'],
            ['kajaga1', 'kajaga1@gmail.id', 'kajaga','1'],
            ['kajaga2', 'kajaga2@gmail.id', 'kajaga','2'],
            ['kajaga3', 'kajaga3@gmail.id', 'kajaga','3'],
    ];
        foreach ($users as $key => $value) {
            $user = User::updateOrCreate([
                'id'    => $key+1,
            ], [
                'nama' => $value[0],
                'email' => $value[1],
                'email_verified_at' => now(),
                'password' => bcrypt('ijinmasuk'),
                'level_user' => $value[2],
                'remember_token' => Str::random(10),
                'zona_id' => $value[3],
            ]);
        }
    }
}

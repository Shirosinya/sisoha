<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Satpam;

class SatpamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $satpams = [
            ['Tsalas Putra F.', 'Y21301115', 'kajaga', 'bekerja', '1', '1'],
            ["Imam Syafi'i", 'K200861', 'wakajaga', 'bekerja', '1', '1'],
            ['Hari Wijoto', 'K200685', 'penjaga', 'bekerja', '1', '1'],
            ['M. Yazid Chisbullah', 'K200783', 'penjaga', 'bekerja', '1', '1'],
            ['M. Bustanul A', 'K040226', 'penjaga', 'bekerja', '1', '1'],
            ['M. Nur Khasan', 'Y21301118', 'penjaga', 'bekerja', '1', '1'],
            ['Achmad Dwi P.', 'K200860', 'penjaga', 'bekerja', '1', '1'],
            ['M. Zainuri', 'K200793', 'penjaga', 'bekerja', '1', '1'],
            ['Sampurno', 'K201593', 'penjaga', 'bekerja', '1', '1'],
            ['Moch. Irsya', 'Y21301232', 'penjaga', 'bekerja', '1', '1'],

            ['Moh. Slamet', 'K200774', 'kajaga', 'bekerja', '2', '1'],
            ['M. Latif Arrohman', 'Y21301179', 'wakajaga', 'bekerja', '2', '1'],
            ["Mas Imam Syafi'i", 'K200629', 'penjaga', 'bekerja', '2', '1'],
            ['Agung Prayogi', 'K201292', 'penjaga', 'bekerja', '2', '1'],
            ['Adi Prasetyo', 'Y21301200', 'penjaga', 'bekerja', '2', '1'],
            ['Feri Andrian', 'K200298', 'penjaga', 'bekerja', '2', '1'],
            ['Septian Nofianto', 'Y21301160', 'penjaga', 'bekerja', '2', '1'],
            ['M. Ubaidillah', 'K200001', 'penjaga', 'bekerja', '2', '1'],
            ['Sufendi', 'K202245', 'penjaga', 'bekerja', '2', '1'],
            ['Dimas Mahardika', 'K202630', 'penjaga', 'bekerja', '2', '1'],
            
            ['Fery Arisandi', 'K020760', 'kajaga', 'bekerja', '3', '1'],
            ['Frediyan FR', 'K200678', 'wakajaga', 'bekerja', '3', '1'],
            ['Alan Kartanu', 'K201599', 'penjaga', 'bekerja', '3', '1'],
            ['Ach. Julianto', 'Y21301124', 'penjaga', 'bekerja', '3', '1'],
            ['Husai Wibisono', 'K020774', 'penjaga', 'bekerja', '3', '1'],
            ['Setyo Budiono', 'K200884', 'penjaga', 'bekerja', '3', '1'],
            ['Machrus', 'K200779', 'penjaga', 'bekerja', '3', '1'],
            ['Arif Fatchur R', 'Y21301123', 'penjaga', 'bekerja', '3', '1'],
            ['Supadiono', 'K200304', 'penjaga', 'bekerja', '3', '1'],
            ['M. Iqbal Syauqi', 'Y21301266', 'penjaga', 'bekerja', '3', '1'],

            ['A. Basir Mustofa', 'Y21301192', 'kajaga', 'bekerja', '4', '1'],
            ['Angga Endra Putra', 'Y21301155', 'wakajaga', 'bekerja', '4', '1'],
            ['Abdullah Kamil', 'Y21301128', 'penjaga', 'bekerja', '4', '1'],
            ['Saiful Bahtiar', 'Y21301163', 'penjaga', 'bekerja', '4', '1'],
            ['M. Syaiful Huda', 'Y21301195', 'penjaga', 'bekerja', '4', '1'],
            ['M. Ismail Faruq', 'K200302', 'penjaga', 'bekerja', '4', '1'],
            ['Rizal Baharudin', 'K202305', 'penjaga', 'bekerja', '4', '1'],
            ['Arfiandani', 'Y21301130', 'penjaga', 'bekerja', '4', '1'],
            ['M. Arsyad Afandi', 'K201754', 'penjaga', 'bekerja', '4', '1'],
            ['M. Rizal Taufani', 'K202634', 'penjaga', 'bekerja', '4', '1'],

            ['A. Dum', 'Y2133', 'kajaga', 'bekerja', '1', '2'],
            ['Dum', 'Y2132315X', 'wakajaga', 'bekerja', '1', '2'],
            ['ABDUM', 'Y2123112X', 'penjaga', 'bekerja', '1', '2'],
            ['DUMDUM', 'Y2123116X', 'penjaga', 'bekerja', '1', '2'],
            ['Dummy Huda', 'Y2123119X', 'penjaga', 'bekerja', '1', '2'],
            ['ddam', 'K20230X', 'penjaga', 'bekerja', '1', '2'],
            ['dummeh', 'K22330X', 'penjaga', 'bekerja', '1', '2'],
            ['dump me', 'Y2230113X', 'penjaga', 'bekerja', '1', '2'],
            ['dumpy', 'K20235X', 'penjaga', 'bekerja', '1', '2'],
            ['adum', 'K20223X', 'penjaga', 'bekerja', '1', '2'],
      ];
        foreach ($satpams as $key => $value) {
            $satpam = Satpam::updateOrCreate([
                'id'    => $key+1,
            ], [
                'nama' => $value[0],
                'nik' => $value[1],
                'jabatan' => $value[2],
                'status' => $value[3],
                'regu_id' => $value[4],
                'zona_id' => $value[5],
            ]);
        }
    }
}

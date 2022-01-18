<!DOCTYPE html>
<html>
<head>    
<style>
#css-table {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
#css-table1 {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
  margin-bottom: 20px;
}

#css-table td, #css-table th {
  border: 1px solid #ddd;
  padding: 8px;
}

#css-table1 td, #css-table1 th {
  border: 2px solid black;
  text-align: center;
  padding: 10px;
}

#css-table tr:nth-child(even){background-color: #f2f2f2;}

/* #css-table tr:hover {background-color: #ddd;} */

#css-table th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #dbdbdb;
  color: black;
  border: 1px solid white;

}#css-table1 th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: center;
  background-color: #ffff;
  color: black;
  border: 2px solid black;
}
</style>
</head>
<body>
    <div class="container-fluid">
        <!-- row -->
        <div class="row">
            <div class="col-lg-12">
                <table id="css-table1" style="background-color:white;">
                <tr>
                    <th rowspan="3"><img src="{{url('images/petro-logo-big.png')}}" height="100px" width="100px" style="margin-bottom:5px;" alt="petro-logo"></th>
                    <th><h2>JURNAL HARIAN POS INDUK ZONA {{$userzona}}
                    @foreach($regus_active as $regu_active)
                        @if($regu_active->id == $reguid)
                        <span>{{strtoupper($regu_active->nama)}}</span>
                        @endif
                    @endforeach</h2></th>
                </tr>
                <tr>
                    <td style="font-weight:bold;">HAL/SUBJEK : LAPORAN HARIAN (JURNAL)<br>
                    HARI/TANGGAL :  <span style="font-weight:bold"><?php setlocale(LC_ALL, 'IND'); echo \Carbon\Carbon::parse($date)->formatLocalized('%A, %d %B %Y'); ?></span><br>
                    REGU/SHIFT : 
                    @foreach($regus_active as $regu_active)
                        @if($regu_active->id == $reguid)
                        <span style="font-weight:bold">{{$regu_active->nama}} / Shift {{$regu_active->shift_id}}</span>
                        <br>
                        PUKUL : {{\Carbon\Carbon::parse($regu_active->shift->mulai)->format('H:i')}} - {{\Carbon\Carbon::parse($regu_active->shift->selesai)->format('H:i')}} 
                        <br>
                        @endif
                    @endforeach
                    </td>
                </tr>
                </table>
            </div>
            <div class="col-lg-12">
                @if($reguid == '1')
                <!-- LAP PERGANTIAN SHIFT -->
                <div class="col-lg-12">
                    <h4>Laporan Pergantian Shift</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Jam</strong></th>
                                <th><strong>Uraian Tugas</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($tugass->where('regu_id','=','1') as $tugas)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}</td>
                                <td>{{$tugas->uraian_tugas}}</td>
                                <td>{{$tugas->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- LAP PERGANTIAN SHIFT END -->
                <!-- TUGAS JAGA -->
                <div class="col-lg-12">
                    <h4>Tugas Jaga</h4>
                    <table id="css-table" class="table ">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>#</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>NAMA</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>NIK</strong></th>
                                <th colspan="4" style="text-align:center;"><strong>JAM AREA TUGAS</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>KETERANGAN</strong></th>
                                <tr>
                                @foreach($detail_shiftA as $dsA)
                                    <th style="text-align:center;"><b>{{\Carbon\Carbon::parse($dsA->waktu_awal)->format('H:i')}}
                                        -{{\Carbon\Carbon::parse($dsA->waktu_akhir)->format('H:i')}}</b></th>
                                @endforeach
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                            @foreach($reguA_arr as $reguA)
                            <?php 
                                $pos_arr = array();
                                ?>
                            <tr>
                                <td style="text-align:center;"><strong>{{$no++}}</strong></td>
                                <td>{{$reguA->nama}}</td>
                                <td style="text-align:center;">{{$reguA->nik}}</td>
                                @if($reguA->jabatan == 'kajaga')
                                    <td colspan="4" style="text-align:center;">KAJAGA</td>
                                @elseif($reguA->jabatan == 'wakajaga')
                                    <td colspan="4" style="text-align:center;">WAKAJAGA</td>
                                @else
                                    @if($pos_satpams->contains('satpam_id', $reguA->id))
                                        @foreach($pos_satpams->where('satpam_id', $reguA->id) as $ps)
                                            @if($ps->satpam_id == $reguA->id && $ps->pos != null)
                                                <td style="text-align:center;">{{$ps->pos->nama_pos}}</td>
                                                <?php array_push($pos_arr,$ps->pos->nama_pos);?> 
                                            @else
                                                <td style="text-align:center;">-</td>
                                                <?php array_push($pos_arr,null);?> 
                                            @endif
                                        @endforeach
                                    @else
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                    @endif
                                @endif
                                <td style="text-align:center;">{{$reguA->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- TUGAS JAGA END -->
                <!-- Pamswakarsa -->
                <div class="col-lg-12">
                    <h4>Laporan Pergantian Shift</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Wilayah</strong></th>
                                <th><strong>Petugas</strong></th>
                                <th><strong>Pekerja Organik</strong></th>
                                <th><strong>Pekerja Bantu</strong></th>
                                <th><strong>Orang Kontrak</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pamswakarsas->where('regu_id','=','1') as $pamswakarsa)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$pamswakarsa->wilayah}}</td>
                                <td>{{$pamswakarsa->nama_petugas}}</td>
                                <td>{{$pamswakarsa->po}}</td>
                                <td>{{$pamswakarsa->pb}}</td>
                                <td>{{$pamswakarsa->ok}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pamswakarsa END -->
                <!-- PRODUKSI -->
                <div class="col-lg-12">
                    <h4>Laporan Pergantian Shift</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Wilayah Produksi</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($produksis->where('regu_id','=','1') as $produksi)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$produksi->nama}}</td>
                                <td>{{$produksi->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- PRODUKSI END -->
                <!-- Pemindahan -->
                <div class="col-lg-12">
                    <h4>Pemindahan</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Pemindahan</strong></th>
                                <th><strong>Gudang</strong></th>
                                <th><strong>Tujuan</strong></th>
                                <th><strong>Armada</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pemindahans->where('regu_id','=','1') as $pemindahan)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$pemindahan->nama_pemindahan}}</td>
                                <td>{{$pemindahan->gudang}}</td>
                                <td>{{$pemindahan->tujuan}}</td>
                                <td>{{$pemindahan->armada}}</td>
                                <td>{{$pemindahan->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pemindahan END -->
                <!-- Giat Armada -->
                <div class="col-lg-12">
                    <h4>Giat Armada</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Giat Armada</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($giat_armadas->where('regu_id','=','1') as $giat_armada)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$giat_armada->nama}}</td>
                                <td>{{$giat_armada->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Giat Armada END -->
                <!-- Inventaris -->
                <div class="col-lg-12">
                    <h4>Inventaris</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Barang</strong></th>
                                <th><strong>Jumlah</strong></th>
                                <th><strong>Kondisi</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($inventariss->where('regu_id','=','1') as $inventaris)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$inventaris->barang->nama_barang}}</td>
                                <td>{{$inventaris->barang->jumlah}}</td>
                                <td>{{$inventaris->kondisi}}</td>
                                <td>{{$inventaris->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Inventaris END -->
                <!-- Rekap Tugas -->
                <div class="col-lg-12">
                    <h4>Rekap Tugas</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Jam</strong></th>
                                <th><strong>Uraian Tugas</strong></th>
                                <th><strong>Keterangan</strong></th>
                                <th><strong>Petugas</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($rekap_tugassA as $rekap_tugas)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{\Carbon\Carbon::parse($rekap_tugas->mulai)->format('H:i')}} - {{\Carbon\Carbon::parse($rekap_tugas->selesai)->format('H:i')}}</td>
                                <td>{{$rekap_tugas->uraian_tugas}}</td>
                                <td>{{$rekap_tugas->keterangan}}</td>
                                <td>{{$rekap_tugas->satpam->nama}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Rekap Tugas END -->
                @endif


                @if($reguid == '2')
                <!-- LAP PERGANTIAN SHIFT -->
                <div class="col-lg-12">
                    <h4>Laporan Pergantian Shift</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Jam</strong></th>
                                <th><strong>Uraian Tugas</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($tugass->where('regu_id','=','2') as $tugas)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}</td>
                                <td>{{$tugas->uraian_tugas}}</td>
                                <td>{{$tugas->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- LAP PERGANTIAN SHIFT END  -->
                <!-- TUGAS JAGA -->
                <div class="col-lg-12">
                    <h4>Tugas Jaga</h4>
                    <table id="css-table" class="tabl">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>#</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>NAMA</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>NIK</strong></th>
                                <th colspan="4" style="text-align:center;"><strong>JAM AREA TUGAS</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>KETERANGAN</strong></th>
                                <tr>
                                @foreach($detail_shiftB as $dsB)
                                    <th style="text-align:center;"><b>{{\Carbon\Carbon::parse($dsB->waktu_awal)->format('H:i')}}
                                        -{{\Carbon\Carbon::parse($dsB->waktu_akhir)->format('H:i')}}</b></th>
                                @endforeach
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                            @foreach($reguB_arr as $reguB)
                            <?php 
                                $pos_arr = array();
                                ?>
                            <tr>
                                <td style="text-align:center;"><strong>{{$no++}}</strong></td>
                                <td>{{$reguB->nama}}</td>
                                <td style="text-align:center;">{{$reguB->nik}}</td>
                                @if($reguB->jabatan == 'kajaga')
                                    <td colspan="4" style="text-align:center;">KAJAGA</td>
                                @elseif($reguB->jabatan == 'wakajaga')
                                    <td colspan="4" style="text-align:center;">WAKAJAGA</td>
                                @else
                                    @if($pos_satpams->contains('satpam_id', $reguB->id))
                                        @foreach($pos_satpams->where('satpam_id', $reguB->id) as $ps)
                                            @if($ps->satpam_id == $reguB->id && $ps->pos != null)
                                                <td style="text-align:center;">{{$ps->pos->nama_pos}}</td>
                                                <?php array_push($pos_arr,$ps->pos->nama_pos);?> 
                                            @else
                                                <td style="text-align:center;">-</td>
                                                <?php array_push($pos_arr,null);?> 
                                            @endif
                                        @endforeach
                                    @else
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                    @endif
                                @endif
                                <td style="text-align:center;">{{$reguB->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- TUGAS JAGA END -->
                <!-- Pamswakarsa -->
                <div class="col-lg-12">
                    <h4>Pamswakarsa</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Wilayah</strong></th>
                                <th><strong>Petugas</strong></th>
                                <th><strong>Pekerja Organik</strong></th>
                                <th><strong>Pekerja Bantu</strong></th>
                                <th><strong>Orang Kontrak</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pamswakarsas->where('regu_id','=','2') as $pamswakarsa)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$pamswakarsa->wilayah}}</td>
                                <td>{{$pamswakarsa->nama_petugas}}</td>
                                <td>{{$pamswakarsa->po}}</td>
                                <td>{{$pamswakarsa->pb}}</td>
                                <td>{{$pamswakarsa->ok}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pamswakarsa END -->
                <!-- PRODUKSI -->
                <div class="col-lg-12">
                    <h4>Laporan Pergantian Shift</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Wilayah Produksi</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($produksis->where('regu_id','=','2') as $produksi)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$produksi->nama}}</td>
                                <td>{{$produksi->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- PRODUKSI END -->
                <!-- Pemindahan -->
                <div class="col-lg-12">
                    <h4>Pemindahan</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Pemindahan</strong></th>
                                <th><strong>Gudang</strong></th>
                                <th><strong>Tujuan</strong></th>
                                <th><strong>Armada</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pemindahans->where('regu_id','=','2') as $pemindahan)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$pemindahan->nama_pemindahan}}</td>
                                <td>{{$pemindahan->gudang}}</td>
                                <td>{{$pemindahan->tujuan}}</td>
                                <td>{{$pemindahan->armada}}</td>
                                <td>{{$pemindahan->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pemindahan END -->
                <!-- Giat Armada -->
                <div class="col-lg-12">
                    <h4>Giat Armada</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Giat Armada</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($giat_armadas->where('regu_id','=','2') as $giat_armada)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$giat_armada->nama}}</td>
                                <td>{{$giat_armada->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Giat Armada END -->
                <!-- Inventaris -->
                <div class="col-lg-12">
                    <h4>Inventaris</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Barang</strong></th>
                                <th><strong>Jumlah</strong></th>
                                <th><strong>Kondisi</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($inventariss->where('regu_id','=','2') as $inventaris)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$inventaris->barang->nama_barang}}</td>
                                <td>{{$inventaris->barang->jumlah}}</td>
                                <td>{{$inventaris->kondisi}}</td>
                                <td>{{$inventaris->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Inventaris END -->
                <!-- Rekap Tugas -->
                <div class="col-lg-12">
                    <h4>Rekap Tugas</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Jam</strong></th>
                                <th><strong>Uraian Tugas</strong></th>
                                <th><strong>Keterangan</strong></th>
                                <th><strong>Petugas</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($rekap_tugassB as $rekap_tugas)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{\Carbon\Carbon::parse($rekap_tugas->mulai)->format('H:i')}} - {{\Carbon\Carbon::parse($rekap_tugas->selesai)->format('H:i')}}</td>
                                <td>{{$rekap_tugas->uraian_tugas}}</td>
                                <td>{{$rekap_tugas->keterangan}}</td>
                                <td>{{$rekap_tugas->satpam->nama}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Rekap Tugas END -->
                @endif


                @if($reguid == '3')
                <!-- LAP PERGANTIAN SHIFT -->
                <div class="col-lg-12">
                    <h4>Laporan Pergantian Shift</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Jam</strong></th>
                                <th><strong>Uraian Tugas</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($tugass->where('regu_id','=','3') as $tugas)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}</td>
                                <td>{{$tugas->uraian_tugas}}</td>
                                <td>{{$tugas->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- LAP PERGANTIAN SHIFT END  -->
                <!-- TUGAS JAGA -->
                <div class="col-lg-12">
                    <h4>Tugas Jaga</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>#</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>NAMA</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>NIK</strong></th>
                                <th colspan="4" style="text-align:center;"><strong>JAM AREA TUGAS</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>KETERANGAN</strong></th>
                                <tr>
                                @foreach($detail_shiftC as $dsC)
                                    <th style="text-align:center;"><b>{{\Carbon\Carbon::parse($dsC->waktu_awal)->format('H:i')}}
                                        -{{\Carbon\Carbon::parse($dsC->waktu_akhir)->format('H:i')}}</b></th>
                                @endforeach
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                            @foreach($reguC_arr as $reguC)
                            <?php 
                                $pos_arr = array();
                                ?>
                            <tr>
                                <td style="text-align:center;"><strong>{{$no++}}</strong></td>
                                <td>{{$reguC->nama}}</td>
                                <td style="text-align:center;">{{$reguC->nik}}</td>
                                @if($reguC->jabatan == 'kajaga')
                                    <td colspan="4" style="text-align:center;">KAJAGA</td>
                                @elseif($reguC->jabatan == 'wakajaga')
                                    <td colspan="4" style="text-align:center;">WAKAJAGA</td>
                                @else
                                    @if($pos_satpams->contains('satpam_id', $reguC->id))
                                        @foreach($pos_satpams->where('satpam_id', $reguC->id) as $ps)
                                            @if($ps->satpam_id == $reguC->id && $ps->pos != null)
                                                <td style="text-align:center;">{{$ps->pos->nama_pos}}</td>
                                                <?php array_push($pos_arr,$ps->pos->nama_pos);?> 
                                            @else
                                                <td style="text-align:center;">-</td>
                                                <?php array_push($pos_arr,null);?> 
                                            @endif
                                        @endforeach
                                    @else
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                    @endif
                                @endif
                                <td style="text-align:center;">{{$reguC->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- TUGAS JAGA END -->
                <!-- Pamswakarsa -->
                <div class="col-lg-12">
                    <h4>Pamswakarsa</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Wilayah</strong></th>
                                <th><strong>Petugas</strong></th>
                                <th><strong>Pekerja Organik</strong></th>
                                <th><strong>Pekerja Bantu</strong></th>
                                <th><strong>Orang Kontrak</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pamswakarsas->where('regu_id','=','3') as $pamswakarsa)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$pamswakarsa->wilayah}}</td>
                                <td>{{$pamswakarsa->nama_petugas}}</td>
                                <td>{{$pamswakarsa->po}}</td>
                                <td>{{$pamswakarsa->pb}}</td>
                                <td>{{$pamswakarsa->ok}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pamswakarsa END -->
                <!-- PRODUKSI -->
                <div class="col-lg-12">
                    <h4>Laporan Pergantian Shift</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Wilayah Produksi</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($produksis->where('regu_id','=','3') as $produksi)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$produksi->nama}}</td>
                                <td>{{$produksi->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- PRODUKSI END -->
                <!-- Pemindahan -->
                <div class="col-lg-12">
                    <h4>Pemindahan</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Pemindahan</strong></th>
                                <th><strong>Gudang</strong></th>
                                <th><strong>Tujuan</strong></th>
                                <th><strong>Armada</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pemindahans->where('regu_id','=','3') as $pemindahan)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$pemindahan->nama_pemindahan}}</td>
                                <td>{{$pemindahan->gudang}}</td>
                                <td>{{$pemindahan->tujuan}}</td>
                                <td>{{$pemindahan->armada}}</td>
                                <td>{{$pemindahan->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pemindahan END -->
                <!-- Giat Armada -->
                <div class="col-lg-12">
                    <h4>Giat Armada</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Giat Armada</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($giat_armadas->where('regu_id','=','3') as $giat_armada)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$giat_armada->nama}}</td>
                                <td>{{$giat_armada->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Giat Armada END -->
                <!-- Inventaris -->
                <div class="col-lg-12">
                    <h4>Inventaris</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Barang</strong></th>
                                <th><strong>Jumlah</strong></th>
                                <th><strong>Kondisi</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($inventariss->where('regu_id','=','3') as $inventaris)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$inventaris->barang->nama_barang}}</td>
                                <td>{{$inventaris->barang->jumlah}}</td>
                                <td>{{$inventaris->kondisi}}</td>
                                <td>{{$inventaris->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Inventaris END -->
                <!-- Rekap Tugas -->
                <div class="col-lg-12">
                    <h4>Rekap Tugas</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Jam</strong></th>
                                <th><strong>Uraian Tugas</strong></th>
                                <th><strong>Keterangan</strong></th>
                                <th><strong>Petugas</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($rekap_tugassC as $rekap_tugas)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{\Carbon\Carbon::parse($rekap_tugas->mulai)->format('H:i')}} - {{\Carbon\Carbon::parse($rekap_tugas->selesai)->format('H:i')}}</td>
                                <td>{{$rekap_tugas->uraian_tugas}}</td>
                                <td>{{$rekap_tugas->keterangan}}</td>
                                <td>{{$rekap_tugas->satpam->nama}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Rekap Tugas END -->
                @endif


                @if($reguid == '4')
                <!-- LAP PERGANTIAN SHIFT -->
                <div class="col-lg-12">
                    <h4>Laporan Pergantian Shift</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Jam</strong></th>
                                <th><strong>Uraian Tugas</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($tugass->where('regu_id','=','4') as $tugas)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}</td>
                                <td>{{$tugas->uraian_tugas}}</td>
                                <td>{{$tugas->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- LAP PERGANTIAN SHIFT END  -->
                <!-- TUGAS JAGA -->
                <div class="col-lg-12">
                    <h4>Tugas Jaga</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>#</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>NAMA</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>NIK</strong></th>
                                <th colspan="4" style="text-align:center;"><strong>JAM AREA TUGAS</strong></th>
                                <th rowspan="2" style="vertical-align: middle; text-align:center;"><strong>KETERANGAN</strong></th>
                                <tr>
                                @foreach($detail_shiftD as $dsD)
                                    <th style="text-align:center;"><b>{{\Carbon\Carbon::parse($dsD->waktu_awal)->format('H:i')}}
                                        -{{\Carbon\Carbon::parse($dsD->waktu_akhir)->format('H:i')}}</b></th>
                                @endforeach
                                </tr>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no = 1; ?>
                            @foreach($reguD_arr as $reguD)
                            <?php 
                                $pos_arr = array();
                                ?>
                            <tr>
                                <td style="text-align:center;"><strong>{{$no++}}</strong></td>
                                <td>{{$reguD->nama}}</td>
                                <td style="text-align:center;">{{$reguD->nik}}</td>
                                @if($reguD->jabatan == 'kajaga')
                                    <td colspan="4" style="text-align:center;">KAJAGA</td>
                                @elseif($reguD->jabatan == 'wakajaga')
                                    <td colspan="4" style="text-align:center;">WAKAJAGA</td>
                                @else
                                    @if($pos_satpams->contains('satpam_id', $reguD->id))
                                        @foreach($pos_satpams->where('satpam_id', $reguD->id) as $ps)
                                            @if($ps->satpam_id == $reguD->id && $ps->pos != null)
                                                <td style="text-align:center;">{{$ps->pos->nama_pos}}</td>
                                                <?php array_push($pos_arr,$ps->pos->nama_pos);?> 
                                            @else
                                                <td style="text-align:center;">-</td>
                                                <?php array_push($pos_arr,null);?> 
                                            @endif
                                        @endforeach
                                    @else
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                        <td style="text-align:center;">-</td>
                                    @endif
                                @endif
                                <td style="text-align:center;">{{$reguD->status}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- TUGAS JAGA END -->
                <!-- Pamswakarsa -->
                <div class="col-lg-12">
                    <h4>Pamswakarsa</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Wilayah</strong></th>
                                <th><strong>Petugas</strong></th>
                                <th><strong>Pekerja Organik</strong></th>
                                <th><strong>Pekerja Bantu</strong></th>
                                <th><strong>Orang Kontrak</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pamswakarsas->where('regu_id','=','4') as $pamswakarsa)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$pamswakarsa->wilayah}}</td>
                                <td>{{$pamswakarsa->nama_petugas}}</td>
                                <td>{{$pamswakarsa->po}}</td>
                                <td>{{$pamswakarsa->pb}}</td>
                                <td>{{$pamswakarsa->ok}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pamswakarsa END -->
                <!-- PRODUKSI -->
                <div class="col-lg-12">
                    <h4>Produksi</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Wilayah Produksi</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($produksis->where('regu_id','=','4') as $produksi)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$produksi->nama}}</td>
                                <td>{{$produksi->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- PRODUKSI END -->
                <!-- Pemindahan -->
                <div class="col-lg-12">
                    <h4>Pemindahan</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Pemindahan</strong></th>
                                <th><strong>Gudang</strong></th>
                                <th><strong>Tujuan</strong></th>
                                <th><strong>Armada</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($pemindahans->where('regu_id','=','4') as $pemindahan)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$pemindahan->nama_pemindahan}}</td>
                                <td>{{$pemindahan->gudang}}</td>
                                <td>{{$pemindahan->tujuan}}</td>
                                <td>{{$pemindahan->armada}}</td>
                                <td>{{$pemindahan->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Pemindahan END -->
                <!-- Giat Armada -->
                <div class="col-lg-12">
                    <h4>Giat Armada</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Giat Armada</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($giat_armadas->where('regu_id','=','4') as $giat_armada)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$giat_armada->nama}}</td>
                                <td>{{$giat_armada->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Giat Armada END -->
                <!-- Inventaris -->
                <div class="col-lg-12">
                    <h4>Inventaris</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Barang</strong></th>
                                <th><strong>Jumlah</strong></th>
                                <th><strong>Kondisi</strong></th>
                                <th><strong>Keterangan</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($inventariss->where('regu_id','=','4') as $inventaris)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{$inventaris->barang->nama_barang}}</td>
                                <td>{{$inventaris->barang->jumlah}}</td>
                                <td>{{$inventaris->kondisi}}</td>
                                <td>{{$inventaris->keterangan}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Inventaris END -->
                <!-- Rekap Tugas -->
                <div class="col-lg-12">
                    <h4>Rekap Tugas</h4>
                    <table id="css-table" class="table">
                        <thead>
                            <tr>
                                <th class="width80"><strong>#</strong></th>
                                <th><strong>Jam</strong></th>
                                <th><strong>Uraian Tugas</strong></th>
                                <th><strong>Keterangan</strong></th>
                                <th><strong>Petugas</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            @foreach($rekap_tugassD as $rekap_tugas)
                            <tr>
                                <td><strong>{{$no++}}</strong></td>
                                <td>{{\Carbon\Carbon::parse($rekap_tugas->mulai)->format('H:i')}} - {{\Carbon\Carbon::parse($rekap_tugas->selesai)->format('H:i')}}</td>
                                <td>{{$rekap_tugas->uraian_tugas}}</td>
                                <td>{{$rekap_tugas->keterangan}}</td>
                                <td>{{$rekap_tugas->satpam->nama}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <!-- Rekap Tugas END -->
                @endif
            </div>
            <br><br><br>
                <h4 style="float: right; margin-right:150px;">Gresik, </h4><br><br><br>
                <table id="css-table" style="border: 1px solid black;">
                    <thead>
                        <tr>
                            <th style="text-align: center;">Diterima</th>
                            <th style="text-align: center;">Mengetahui</th>
                            <th style="text-align: center;">Diserahkan</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><br><br><br><br><br></td>
                            <td><br><br><br><br><br></td>
                            <td><br><br><br><br><br></td>
                        </tr>
                    </tbody>
                </table>
        </div>
    </div>
<
</body>
</html>
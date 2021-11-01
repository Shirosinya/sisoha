{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
			<div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Jurnal</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Rekap</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="col-lg-4">
                            <form id="dateForm" name="dateForm">
                                <label id="dateSelected">Tanggal</label>
                                <div class="input-group" style="margin-bottom: 20px;">
                                    <input type="date" class="form-control" onfocus="(this.type='date')" name="datepicker" value="{{$date}}" id="datepicker">
                                    <input placeholder="Submit" value = "filter" onClick="javascript: window.location.href = '/rekap?datepicker=' + document.getElementById('datepicker').value;"
                                    type="button" class="btn btn-secondary btn-xsm" id="submitMe" style="margin-left: 20px;">
                                    <!-- <a href="" class="btn btn-info btn-xsm" style="margin-bottom: 20px;"><i class="la la-file-pdf-o"></i>Export PDF</a> -->
                                </div>                                
                            </form>
                        </div>
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">REKAP</h4>
                                <h4 class="card-title"><?php setlocale(LC_ALL, 'IND');
                                    echo \Carbon\Carbon::parse($date)->formatLocalized('%A, %d %B %Y'); ?></h4>
                            </div>
                            <div class="card-body">
                                <div class="default-tab">
                                    <ul class="nav nav-tabs" id="tabMenu" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-toggle="tab" href="#tab-reguA"><i class="la la-group mr-2"></i>Regu A</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab-reguB"><i class="la la-group mr-2"></i>Regu B</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab-reguC"><i class="la la-group mr-2"></i>Regu C</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-toggle="tab" href="#tab-reguD"><i class="la la-group mr-2"></i>Regu D</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade show active" id="tab-reguA" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-4">
                                                    <a href="/export-pdf/{{$date}}/1" class="btn btn-info btn-xsm" style="margin-bottom: 20px;"><i class="la la-file-pdf-o"></i>Export PDF</a>
                                                </div>
                                                <!-- LAP PERGANTIAN SHIFT -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Laporan Pergantian Shift</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- LAP PERGANTIAN SHIFT END -->
                                                <!-- TUGAS JAGA -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Tugas Jaga</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- TUGAS JAGA END -->
                                                <!-- Pamswakarsa -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Pamswakarsa</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Wilayah</strong></th>
                                                                            <th><strong>Petugas</strong></th>
                                                                            <th><strong>Pekerja Organik</strong></th>
                                                                            <th><strong>Pekerja Bantu</strong></th>
                                                                            <th><strong>Orang Kontrak</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Pamswakarsa END -->
                                                <!-- PRODUKSI -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Produksi</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Wilayah Produksi</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- PRODUKSI END -->
                                                <!-- Pemindahan -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Pemindahan</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Pemindahan</strong></th>
                                                                            <th><strong>Gudang</strong></th>
                                                                            <th><strong>Tujuan</strong></th>
                                                                            <th><strong>Armada</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Pemindahan END -->
                                                <!-- Giat Armada -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Giat Armada</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Giat Armada</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Giat Armada END -->
                                                <!-- Inventaris -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Inventaris</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Barang</strong></th>
                                                                            <th><strong>Jumlah</strong></th>
                                                                            <th><strong>Kondisi</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Inventaris END -->
                                                <!-- Rekap Tugas -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Rekap Tugas</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Jam</strong></th>
                                                                            <th><strong>Uraian Tugas</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th><strong>Petugas</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Rekap Tugas END -->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-reguB" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-4">
                                                    <a href="/export-pdf/{{$date}}/2" class="btn btn-info btn-xsm" style="margin-bottom: 20px;"><i class="la la-file-pdf-o"></i>Export PDF</a>
                                                </div>
                                                <!-- LAP PERGANTIAN SHIFT -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Laporan Pergantian Shift</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- LAP PERGANTIAN SHIFT END  -->
                                                <!-- TUGAS JAGA -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Tugas Jaga</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- TUGAS JAGA END -->
                                                <!-- Pamswakarsa -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Pamswakarsa</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Wilayah</strong></th>
                                                                            <th><strong>Petugas</strong></th>
                                                                            <th><strong>Pekerja Organik</strong></th>
                                                                            <th><strong>Pekerja Bantu</strong></th>
                                                                            <th><strong>Orang Kontrak</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Pamswakarsa END -->
                                                <!-- PRODUKSI -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Produksi</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Wilayah Produksi</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- PRODUKSI END -->
                                                <!-- Pemindahan -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Pemindahan</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Pemindahan</strong></th>
                                                                            <th><strong>Gudang</strong></th>
                                                                            <th><strong>Tujuan</strong></th>
                                                                            <th><strong>Armada</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Pemindahan END -->
                                                <!-- Giat Armada -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Giat Armada</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Giat Armada</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Giat Armada END -->
                                                <!-- Inventaris -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Inventaris</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Barang</strong></th>
                                                                            <th><strong>Jumlah</strong></th>
                                                                            <th><strong>Kondisi</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Inventaris END -->
                                                <!-- Rekap Tugas -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Rekap Tugas</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Jam</strong></th>
                                                                            <th><strong>Uraian Tugas</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th><strong>Petugas</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Rekap Tugas END -->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-reguC" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-4">
                                                    <a href="/export-pdf/{{$date}}/3" class="btn btn-info btn-xsm" style="margin-bottom: 20px;"><i class="la la-file-pdf-o"></i>Export PDF</a>
                                                </div>
                                                <!-- LAP PERGANTIAN SHIFT -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Laporan Pergantian Shift</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- LAP PERGANTIAN SHIFT END  -->
                                                <!-- TUGAS JAGA -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Tugas Jaga</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- TUGAS JAGA END -->
                                                <!-- Pamswakarsa -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Pamswakarsa</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Wilayah</strong></th>
                                                                            <th><strong>Petugas</strong></th>
                                                                            <th><strong>Pekerja Organik</strong></th>
                                                                            <th><strong>Pekerja Bantu</strong></th>
                                                                            <th><strong>Orang Kontrak</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Pamswakarsa END -->
                                                <!-- PRODUKSI -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Produksi</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Wilayah Produksi</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- PRODUKSI END -->
                                                <!-- Pemindahan -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Pemindahan</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Pemindahan</strong></th>
                                                                            <th><strong>Gudang</strong></th>
                                                                            <th><strong>Tujuan</strong></th>
                                                                            <th><strong>Armada</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Pemindahan END -->
                                                <!-- Giat Armada -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Giat Armada</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Giat Armada</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Giat Armada END -->
                                                <!-- Inventaris -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Inventaris</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Barang</strong></th>
                                                                            <th><strong>Jumlah</strong></th>
                                                                            <th><strong>Kondisi</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Inventaris END -->
                                                <!-- Rekap Tugas -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Rekap Tugas</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Jam</strong></th>
                                                                            <th><strong>Uraian Tugas</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th><strong>Petugas</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Rekap Tugas END -->
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-reguD" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="col-lg-4">
                                                    <a href="/export-pdf/{{$date}}/4" class="btn btn-info btn-xsm" style="margin-bottom: 20px;"><i class="la la-file-pdf-o"></i>Export PDF</a>
                                                </div>
                                                <!-- LAP PERGANTIAN SHIFT -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Laporan Pergantian Shift</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- LAP PERGANTIAN SHIFT END  -->
                                                <!-- TUGAS JAGA -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Tugas Jaga</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- TUGAS JAGA END -->
                                                <!-- Pamswakarsa -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Pamswakarsa</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Wilayah</strong></th>
                                                                            <th><strong>Petugas</strong></th>
                                                                            <th><strong>Pekerja Organik</strong></th>
                                                                            <th><strong>Pekerja Bantu</strong></th>
                                                                            <th><strong>Orang Kontrak</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Pamswakarsa END -->
                                                <!-- PRODUKSI -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Produksi</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Wilayah Produksi</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- PRODUKSI END -->
                                                <!-- Pemindahan -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Pemindahan</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Pemindahan</strong></th>
                                                                            <th><strong>Gudang</strong></th>
                                                                            <th><strong>Tujuan</strong></th>
                                                                            <th><strong>Armada</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Pemindahan END -->
                                                <!-- Giat Armada -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Giat Armada</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Giat Armada</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Giat Armada END -->
                                                <!-- Inventaris -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Inventaris</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Barang</strong></th>
                                                                            <th><strong>Jumlah</strong></th>
                                                                            <th><strong>Kondisi</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Inventaris END -->
                                                <!-- Rekap Tugas -->
                                                <div class="col-lg-12">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h4 class="card-title">Rekap Tugas</h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table class="table table-responsive-md">
                                                                    <thead>
                                                                        <tr>
                                                                            <th class="width80"><strong>#</strong></th>
                                                                            <th><strong>Jam</strong></th>
                                                                            <th><strong>Uraian Tugas</strong></th>
                                                                            <th><strong>Keterangan</strong></th>
                                                                            <th><strong>Petugas</strong></th>
                                                                            <th></th>
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
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Rekap Tugas END -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    //redirect to specific tab
    $(document).ready(function () {
        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
    });
</script>
@endsection
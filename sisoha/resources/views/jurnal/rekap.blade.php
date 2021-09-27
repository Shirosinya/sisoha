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
                    <div class="col-lg-4">
                        <div class="basic-dropdown" style="float">
                            <div class="dropdown">
                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                    Dropdown button
                                </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#">Link 1</a>
                                    <a class="dropdown-item" href="#">Link 2</a>
                                    <a class="dropdown-item" href="#">Link 3</a>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            @foreach($tugass as $tugas)
                                            <tr>
                                                <td><strong>{{$no++}}</strong></td>
                                                <td>{{\Carbon\Carbon::parse($tugas->shift->mulai)->format('H:i')}}</td>
                                                <td>{{$tugas->uraian_tugas}}</td>
                                                <td>{{$tugas->keterangan}}</td>
                                                <td>
													<div class="dropdown">
														<button type="button" class="btn btn-primary light sharp" data-toggle="dropdown">
															<svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="#">Edit</a>
															<a class="dropdown-item" href="#">Delete</a>
														</div>
													</div>
												</td>
                                            </tr>
                                            @endforeach
                                            <?php $no = 1; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                                <th rowspan="2" style="vertical-align: middle;"><strong>#</strong></th>
                                                <th rowspan="2" style="vertical-align: middle;"><strong>NAMA</strong></th>
                                                <th rowspan="2" style="vertical-align: middle;"><strong>NIK</strong></th>
                                                <th colspan="4" style="text-align:center;"><strong>JAM AREA TUGAS</strong></th>
                                                <th rowspan="2" style="vertical-align: middle;"><strong>KETERANGAN</strong></th>
                                                <tr>
                                                    <th style="text-align:center;"><b>14.00-16.00</b></th>
                                                    <th style="text-align:center;"><b>16.00-18.00</b></th>
                                                    <th style="text-align:center;"><b>18.00-20.00</b></th>
                                                    <th style="text-align:center;"><b>20.00-22.00</b></th>
                                                </tr>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($tugas_jagas as $tugas_jaga)
                                            <tr>
                                                <td><strong>{{$no++}}</strong></td>
                                                <td>{{$tugas_jaga->nama}}</td>
                                                <td>{{$tugas_jaga->nik}}</td>
                                                <td>{{$tugas_jaga->nama_pos}}</td>
                                                <td>{{$tugas_jaga->nama_pos}}</td>
                                                <td>{{$tugas_jaga->nama_pos}}</td>
                                                <td>{{$tugas_jaga->nama_pos}}</td>
                                                <td>{{$tugas_jaga->status}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
			
@endsection
<!-- <table class="tableizer-table">
    <thead>
        <tr class="tableizer-firstrow">
            <th>213</th>
            <th>123</th>
            <th>2333</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>234</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>aa</td>
            <td>bb</td>
            <td>cc</td>
            <td>dd</td>
            <td></td>
        </tr>
    </tbody>
</table> -->
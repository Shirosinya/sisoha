{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')

			<div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Jurnal</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Tugas Jaga</a></li>
					</ol>
                </div>
                <!-- row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <!-- <div class="card-header">
                                <h4 class="card-title">Tugas Jaga</h4>
                            </div> -->
                            <!-- <button type="button" class="btn btn-primary mb-2" data-toggle="modal"
                            data-target="#tambahModal">+ Tambah Personil</button> -->
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
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-md">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>#</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>NAMA</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>NIK</strong></th>
                                                                <th colspan="4" style="text-align:center;"><strong>JAM AREA TUGAS</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>KETERANGAN</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>AKSI</strong></th>
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
                                                            <?php $pos_arr = array(); ?>
                                                            <tr>
                                                                <td><strong>{{$no++}}</strong></td>
                                                                <td>{{$reguA->nama}}</td>
                                                                <td>{{$reguA->nik}}</td>
                                                                @if($reguA->jabatan == 'kajaga')
                                                                    <td colspan="4" style="text-align:center;">KAJAGA</td>
                                                                @elseif($reguA->jabatan == 'wakajaga')
                                                                    <td colspan="4" style="text-align:center;">WAKAJAGA</td>
                                                                @elseif($reguA->pos_satpam->isEmpty())
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                @else
                                                                    @foreach($reguA->pos_satpam as $pos)
                                                                        <td style="text-align:center;">{{$pos->pos->nama_pos}}</td>
                                                                        <?php array_push($pos_arr,$pos->pos->nama_pos);?>
                                                                    @endforeach
                                                                @endif
                                                                <td style="text-align:center;">{{$reguA->status}}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <button type="button" style="border:none;" data-toggle="modal" data-target="#editModal{{$reguA->id}}">
                                                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 btn-edit"><i class="fa fa-pencil"></i></a>
                                                                        </button>    
                                                                    </div>
                                                                    <!-- MODAL UPDATE -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$reguA->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Update Data Personil</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="form-plot-personil" name="form-plot-personil" method="POST" action="/tugas-jaga/{{$reguA->id}}/update">
                                                                                        @csrf
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Nama</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input readonly name="nama" value="{{ $reguA->nama }}" type="text" class="form-control" placeholder="Masukkan Nama Personil">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">NIK</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input readonly name="nik" value="{{ $reguA->nik }}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan NIK">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label" for="exampleFormControlSelect1">Pos 1</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name="pos_1" class="form-control" id="exampleFormControlSelect1">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[0] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect2">Pos 2</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_2" class="form-control" id="exampleFormControlSelect2">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[1] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect3">Pos 3</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_3" class="form-control" id="exampleFormControlSelect3">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[2] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect4">Pos 4</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_4" class="form-control" id="exampleFormControlSelect4">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[3] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <input type="submit" class="btn btn-primary" value="Ubah">
                                                                                        </div>
                                                                                    </form>
                                                                            </div>    
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE END -->
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-reguB" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-md">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>#</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>NAMA</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>NIK</strong></th>
                                                                <th colspan="4" style="text-align:center;"><strong>JAM AREA TUGAS</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>KETERANGAN</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>AKSI</strong></th>
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
                                                                <?php $pos_arr = array(); ?>
                                                            <tr>
                                                                <td><strong>{{$no++}}</strong></td>
                                                                <td>{{$reguB->nama}}</td>
                                                                <td>{{$reguB->nik}}</td>
                                                                @if($reguB->jabatan == 'kajaga')
                                                                    <td colspan="4" style="text-align:center;">KAJAGA</td>
                                                                @elseif($reguB->jabatan == 'wakajaga')
                                                                    <td colspan="4" style="text-align:center;">WAKAJAGA</td>
                                                                @elseif($reguB->pos_satpam->isEmpty())
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                @else
                                                                    @foreach($reguB->pos_satpam as $pos)
                                                                        <td style="text-align:center;">{{$pos->pos->nama_pos}}</td>
                                                                        <?php array_push($pos_arr,$pos->pos->nama_pos);?>
                                                                    @endforeach
                                                                @endif
                                                                <td style="text-align:center;">{{$reguB->status}}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <button type="button" style="border:none;" data-toggle="modal" data-target="#editModal{{$reguB->id}}">
                                                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 btn-edit"><i class="fa fa-pencil"></i></a>
                                                                        </button>    
                                                                    </div>
                                                                    <!-- MODAL UPDATE -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$reguB->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Update Data Personil</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="form-plot-personil" name="form-plot-personil" method="POST" action="/tugas-jaga/{{$reguB->id}}/update">
                                                                                        @csrf
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Nama</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input readonly name="nama" value="{{ $reguB->nama }}" type="text" class="form-control" placeholder="Masukkan Nama Personil">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">NIK</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input readonly name="nik" value="{{ $reguB->nik }}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan NIK">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label" for="exampleFormControlSelect1">Pos 1</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name="pos_1" class="form-control" id="exampleFormControlSelect1">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[0] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect2">Pos 2</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_2" class="form-control" id="exampleFormControlSelect2">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[1] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect3">Pos 3</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_3" class="form-control" id="exampleFormControlSelect3">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[2] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect4">Pos 4</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_4" class="form-control" id="exampleFormControlSelect4">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[3] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <input type="submit" class="btn btn-primary" value="Ubah">
                                                                                        </div>
                                                                                    </form>
                                                                            </div>    
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE END -->
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-reguC" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-md">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>#</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>NAMA</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>NIK</strong></th>
                                                                <th colspan="4" style="text-align:center;"><strong>JAM AREA TUGAS</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>KETERANGAN</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>AKSI</strong></th>
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
                                                            <?php $pos_arr = array(); ?>
                                                            <tr>
                                                                <td><strong>{{$no++}}</strong></td>
                                                                <td>{{$reguC->nama}}</td>
                                                                <td>{{$reguC->nik}}</td>
                                                                @if($reguC->jabatan == 'kajaga')
                                                                    <td colspan="4" style="text-align:center;">KAJAGA</td>
                                                                @elseif($reguC->jabatan == 'wakajaga')
                                                                    <td colspan="4" style="text-align:center;">WAKAJAGA</td>
                                                                @elseif($reguC->pos_satpam->isEmpty())
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                @else
                                                                    @foreach($reguC->pos_satpam as $pos)
                                                                        <td style="text-align:center;">{{$pos->pos->nama_pos}}</td>
                                                                        <?php array_push($pos_arr,$pos->pos->nama_pos);?>
                                                                    @endforeach
                                                                @endif
                                                                <td style="text-align:center;">{{$reguC->status}}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <button type="button" style="border:none;" data-toggle="modal" data-target="#editModal{{$reguC->id}}">
                                                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 btn-edit"><i class="fa fa-pencil"></i></a>
                                                                        </button>    
                                                                    </div>
                                                                    <!-- MODAL UPDATE -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$reguC->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Update Data Personil</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="form-plot-personil" name="form-plot-personil" method="POST" action="/tugas-jaga/{{$reguC->id}}/update">
                                                                                        @csrf
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Nama</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input readonly name="nama" value="{{ $reguC->nama }}" type="text" class="form-control" placeholder="Masukkan Nama Personil">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">NIK</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input readonly name="nik" value="{{ $reguC->nik }}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan NIK">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label" for="exampleFormControlSelect1">Pos 1</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name="pos_1" class="form-control" id="exampleFormControlSelect1">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[0] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect2">Pos 2</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_2" class="form-control" id="exampleFormControlSelect2">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[1] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect3">Pos 3</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_3" class="form-control" id="exampleFormControlSelect3">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[2] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect4">Pos 4</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_4" class="form-control" id="exampleFormControlSelect4">
                                                                                                    <option value="">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[3] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <input type="submit" class="btn btn-primary" value="Ubah">
                                                                                        </div>
                                                                                    </form>
                                                                            </div>    
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE END -->
                                                                </td>
                                                            </tr>
                                                            @endforeach
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="tab-reguD" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="table-responsive">
                                                    <table class="table table-responsive-md">
                                                        <thead>
                                                            <tr>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>#</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>NAMA</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>NIK</strong></th>
                                                                <th colspan="4" style="text-align:center;"><strong>JAM AREA TUGAS</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>KETERANGAN</strong></th>
                                                                <th rowspan="2" style="vertical-align: middle;"><strong>AKSI</strong></th>
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
                                                            <?php $pos_arr = array(); ?>
                                                            <tr>
                                                                <td><strong>{{$no++}}</strong></td>
                                                                <td>{{$reguD->nama}}</td>
                                                                <td>{{$reguD->nik}}</td>
                                                                @if($reguD->jabatan == 'kajaga')
                                                                    <td colspan="4" style="text-align:center;">KAJAGA</td>
                                                                @elseif($reguD->jabatan == 'wakajaga')
                                                                    <td colspan="4" style="text-align:center;">WAKAJAGA</td>
                                                                @elseif($reguD->pos_satpam->isEmpty())
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                    <td style="text-align:center;">-</td>
                                                                @else
                                                                    @foreach($reguD->pos_satpam as $pos)
                                                                        <td style="text-align:center;">{{$pos->pos == null ? '-' : $pos->pos->nama_pos}}</td>
                                                                        <?php array_push($pos_arr, $pos->pos == null ? '-' : $pos->pos->nama_pos);?>
                                                                    @endforeach
                                                                @endif
                                                                <td style="text-align:center;">{{$reguD->status}}</td>
                                                                <td>
                                                                    <div class="d-flex">
                                                                        <button type="button" style="border:none;" data-toggle="modal" data-target="#editModal{{$reguD->id}}">
                                                                            <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 btn-edit"><i class="fa fa-pencil"></i></a>
                                                                        </button>    
                                                                    </div>
                                                                    <!-- MODAL UPDATE -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$reguD->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Update Data Personil</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="form-plot-personil" name="form-plot-personil" method="POST" action="/tugas-jaga/{{$reguD->id}}/update">
                                                                                        @csrf
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Nama</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input readonly name="nama" value="{{ $reguD->nama }}" type="text" class="form-control" placeholder="Masukkan Nama Personil">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">NIK</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input readonly name="nik" value="{{ $reguD->nik }}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan NIK">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label" for="exampleFormControlSelect1">Pos 1</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name="pos_1" class="form-control" id="exampleFormControlSelect1">
                                                                                                    <option value="null">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[0] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect2">Pos 2</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_2" class="form-control" id="exampleFormControlSelect2">
                                                                                                    <option value="null">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[1] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect3">Pos 3</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_3" class="form-control" id="exampleFormControlSelect3">
                                                                                                    <option value="null">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[2] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label" for="exampleFormControlSelect4">Pos 4</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name = "pos_4" class="form-control" id="exampleFormControlSelect4">
                                                                                                    <option value="null">-</option>
                                                                                                    @foreach($poss as $true_pos)
                                                                                                        @if(empty($pos_arr))
                                                                                                            <option value="{{$true_pos->nama_pos}}" >{{$true_pos->nama_pos}}</option>
                                                                                                        @else
                                                                                                            <option value="{{$true_pos->nama_pos}}" {{$true_pos->nama_pos == $pos_arr[3] ? 'selected' : '' }} >{{$true_pos->nama_pos}}</option>
                                                                                                        @endif
                                                                                                    @endforeach
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <input type="submit" class="btn btn-primary" value="Ubah">
                                                                                        </div>
                                                                                    </form>
                                                                            </div>    
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE END -->
                                                                </td>
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
                        </div>
                    </div>
                </div>
            </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    //redirect to specific tab
    $(document).ready(function () {
        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show active')
    });
</script>
@endsection
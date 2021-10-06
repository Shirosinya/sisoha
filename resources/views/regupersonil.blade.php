{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
<div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Personil dan Regu</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-lg-12">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <?php 
                        $parameter = app('request')->input('datepicker');
                        $today = date('Y-m-d');
                        // echo $today;
                        ?>
                        <div class="card">
                            <!-- <div class="card-header">
                                <h4 class="card-title">Regu dan Personil</h4>
                            </div> -->
                            <div class="card-body">
                                <!-- Nav tabs -->
                                <div class="default-tab">
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link {{ $parameter == null ? 'active' : '' }}" data-toggle="tab" href="#tab-personil"><i class="la la-user mr-2"></i>Personil</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link {{ $parameter != null ? 'active' : '' }}" data-toggle="tab" href="#tab-regu"><i class="la la-group mr-2"></i>Regu</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div class="tab-pane fade {{ $parameter == null ? 'show active' : '' }}" id="tab-personil" role="tabpanel">
                                            <div class="pt-4">
                                                <div class="card">
                                                    <!-- MODAL TAMBAH -->
                                                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahModal">+ Tambah Personil</button>
                                                        <div class="modal fade bd-example-modal-lg" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
                                                            <div class="modal-dialog modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Tambah Data Personil</h5>
                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form id="form-create-personil" name="form-create-personil" method="POST" action="{{route('createpersonil')}}">
                                                                            @csrf
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Nama</label>
                                                                                <div class="col-sm-9">
                                                                                    <input name="nama" type="text" class="form-control" placeholder="Masukkan Nama Personil">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">NIK</label>
                                                                                <div class="col-sm-9">
                                                                                    <input name="nik" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan NIK">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Jabatan</label>
                                                                                <div class="col-sm-9">
                                                                                    <select name="jabatan" class="form-control" id="jabatan">
                                                                                    <option value="penjaga">Penjaga</option>
                                                                                    <option value="kajaga">Kajaga</option>
                                                                                    <option value="wakajaga">Wakajaga</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Status</label>
                                                                                <div class="col-sm-9">
                                                                                    <select name="status" class="form-control" id="status">
                                                                                    <option value="bekerja">Bekerja</option>
                                                                                    <option value="ganti shift">Ganti Shift</option>
                                                                                    <option value="lembur">Lembur</option>
                                                                                    <option value="cuti">Cuti</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label class="col-sm-3 col-form-label">Regu</label>
                                                                                <div class="col-sm-9">
                                                                                    <select name="regu" class="form-control" id="regu">
                                                                                    <option value="1">Regu A</option>
                                                                                    <option value="2">Regu B</option>
                                                                                    <option value="3">Regu C</option>
                                                                                    <option value="4">Regu D</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                        
                                                                    </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                <button type="submit" class="btn btn-primary">Tambah</button>
                                                                            </div>
                                                                        </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- MODAL TAMBAH END -->
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="example" class="display min-w850">
                                                                <thead>
                                                                    <tr>
                                                                        <th>#</th>
                                                                        <th>Nama</th>
                                                                        <th>NIK</th>
                                                                        <th>Jabatan</th>
                                                                        <th>Zona</th>
                                                                        <th>Regu</th>
                                                                        <th>Status</th>
                                                                        <th>Aksi</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody> 
                                                                <?php $i = 1;?>
                                                                @foreach($satpams as $value )
                                                                    <tr>
                                                                        <td>{{$i++}}</td>
                                                                        <td>{{$value->nama}}</td>
                                                                        <td>{{$value->nik}}</td>
                                                                        <td>{{$value->jabatan}}</td>
                                                                        <td>{{$value->zona->nama}}</td>
                                                                        <td>{{$value->regu->nama}}</td>
                                                                        <td>{{$value->status}}</td>
                                                                        <td>
                                                                            <div class="d-flex">
                                                                                <button type="button" style="border:none;" data-toggle="modal" data-target="#editModal{{$value->id}}">
                                                                                    <a href="#" class="btn btn-primary shadow btn-xs sharp mr-1 btn-edit"><i class="fa fa-pencil"></i></a>
                                                                                </button>
                                                                                <button type="button" style="border:none;" data-toggle="modal" data-target="#hapusModal{{$value->id}}">
                                                                                    <a href="#" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                                                                                </button>
                                                                                
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <!-- MODAL UPDATE -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$value->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Update Data Personil</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <form id="form-update-personil" name="form-update-personil" method="POST" action="/regupersonil/{{$value->id}}/update">
                                                                                        @csrf
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Nama</label>
                                                                                            <div class="col-sm-9">
                                                                                                
                                                                                                <input name="nama" value="{{ $value->nama }}" type="text" class="form-control" placeholder="Masukkan Nama Personil">
                                                                                            
                                                                                                <!-- <input name="nama" value="" type="text" class="form-control" placeholder="Masukkan Nama Personil"> -->
                                                                                            
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">NIK</label>
                                                                                            <div class="col-sm-9">
                                                                                                <input name="nik" value="{{ $value->nik }}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan NIK">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Jabatan</label>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="jabatan" id="exampleRadios1" value="penjaga" {{ $value->jabatan == 'penjaga' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios1">Penjaga</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="jabatan" id="exampleRadios2" value="kajaga" {{ $value->jabatan == 'kajaga' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios2">Kajaga</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="jabatan" id="exampleRadios3" value="wakajaga" {{ $value->jabatan == 'wakajaga' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios3">Wakajaga</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Status</label>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios1" value="bekerja" {{ $value->status == 'bekerja' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios1">Bekerja</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios2" value="ganti shift" {{ $value->status == 'ganti shift' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios2">Ganti Shift</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios3" value="lembur" {{ $value->status == 'lembur' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios3">Lembur</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="status" id="exampleRadios4" value="cuti" {{ $value->status == 'cuti' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios4">Cuti</label>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Regu</label>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="regu" id="exampleRadios1" value="1" {{ $value->regu_id == '1' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios1">Regu A</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="regu" id="exampleRadios2" value="2" {{ $value->regu_id == '2' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios2">Regu B</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="regu" id="exampleRadios3" value="3" {{ $value->regu_id == '3' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios3">Regu C</label>
                                                                                                </div>
                                                                                                <div class="form-check">
                                                                                                    <input class="form-check-input" type="radio" name="regu" id="exampleRadios4" value="4" {{ $value->regu_id == '4' ? 'checked' : '' }}>
                                                                                                    <label class="form-check-label" for="exampleRadios4">Regu D</label>
                                                                                                </div>
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
                                                                    <!--MODAL HAPUS-->
                                                                    <div class="modal fade" id="hapusModal{{$value->id}}">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <div class="alert alert-danger notification">
                                                                                        <p class="notificaiton-title mb-2"><strong>Perhatian! </strong> Yakin akan menghapus?
                                                                                        </p>
                                                                                        <p>Data yang dihapus tidak dapat dikembalikan.</p> 
                                                                                    </div>
                                                                                        <form method="POST" action="/regupersonil/{{$value->id}}/destroy">
                                                                                        @csrf
                                                                                            <button type="submit" class="btn btn-danger btn-sm">Confirm</button>
                                                                                        </form>
                                                                                        <button class="btn btn-link btn-sm" data-dismiss="modal">Cancel</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL HAPUS END -->
                                                                @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>    
                                                    </div>
                                                </div>
                                            </div>    
                                        </div>
                                        <div class="tab-pane fade {{ $parameter != null ? 'show active' : '' }}" id="tab-regu">
                                            <div class="pt-4">
                                                <div class="card">
                                                            <div class="col-lg-12">
                                                                <div class="col-lg-3">
                                                                    <!-- <p class="mb-1">{{ app('request')->input('datepicker') }}</p> -->
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <form id="dateForm" name="dateForm">
                                                                        <label id="dateSelected">Tanggal</label>
                                                                        <input type="date" class="form-control" onfocus="(this.type='date')" name="datepicker" value="{{$parameter != null ? $parameter : $today}}" id="datepicker">
                                                                        <input placeholder="Submit" value = "filter" onClick="javascript: window.location.href = '/regupersonil?datepicker=' + document.getElementById('datepicker').value;" type="button" id="submitMe" style="width:100px;">
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        <div class="card-body">
                                                            <div class="table-responsive">
                                                                <table id="regu-table" class="table table-responsive-sm">
                                                                    <thead>
                                                                        <tr>
                                                                            <th width="100px">#</th>
                                                                            <th width="200px">Nama Regu</th>
                                                                            <th width="200px">Shift Hari ini</th>
                                                                            <th width="150px">Mulai</th>
                                                                            <th width="150px">Selesai</th>
                                                                            <th width="100px">Detail</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <?php $no = 1;?>
                                                                    @foreach($regus as $regu)
                                                                        <tr>
                                                                            <td>{{$no++}}</td>
                                                                            <td>{{$regu->nama}}</td>
                                                                            <td>{{strtoupper($shifts[$no-2]) == '-' ? 'OFF' : strtoupper($shifts[$no-2]) }}</td>
                                                                            <td>{{$regu->shift->mulai == null ? '' : \Carbon\Carbon::parse($regu->shift->mulai)->format('H:i')}}</td>
                                                                            <td>{{$regu->shift->selesai == null ? '' : \Carbon\Carbon::parse($regu->shift->selesai)->format('H:i')}}</td>
                                                                            <td><div class="d-flex">
                                                                                <button type="button" style="border:none;" data-toggle="modal" data-target="#viewModal{{$regu->id}}">
                                                                                    <a href="#" class="btn btn-secondary shadow btn-xs sharp mr-1"><i class="fa fa-eye"></i></a>
                                                                                </button>
                                                                                </div>
                                                                                <!-- MODAL VIEW REGU -->        
                                                                                <div class="modal fade bd-example-modal-lg" id="viewModal{{$regu->id}}">
                                                                                    <div class="modal-dialog modal-lg">
                                                                                        <div class="modal-content">
                                                                                            <div class="modal-header">
                                                                                                <h2 class="modal-title"><strong>{{$value->zona->nama}} - {{$regu->nama}}</strong></h2>
                                                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                                </button>
                                                                                            </div>
                                                                                            <div class="modal-body">
                                                                                                <div class="table-responsive">
                                                                                                    <table id="example" class="display min-w850">
                                                                                                        <thead>
                                                                                                            <tr>
                                                                                                                <th width="30px">#</th>
                                                                                                                <th width="150px">Nama</th>
                                                                                                                <th width="100px">Nik</th>
                                                                                                                <th width="100px">Jabatan</th>
                                                                                                                <th width="120px">Status</th>
                                                                                                            </tr>
                                                                                                        </thead>
                                                                                                        <tbody>
                                                                                                            <?php $tag = 1;?>
                                                                                                            @foreach($satpams as $value)
                                                                                                            <tr>
                                                                                                                @if($value->regu_id == $regu->id)
                                                                                                                    <td>{{$tag++}}</td>
                                                                                                                    <td>{{$value->nama}}</td>
                                                                                                                    <td>{{$value->nik}}</td>
                                                                                                                    <td>{{$value->jabatan}}</td>
                                                                                                                    <td>{{$value->status}}</td>
                                                                                                                @endif
                                                                                                            </tr>
                                                                                                            @endforeach
                                                                                                        </tbody>
                                                                                                    </table>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <!-- MODAL VIEW REGU END-->
                                                                            </td>
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
                </div>
</div>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    // $.ajaxSetup({
    // headers: {
    //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    // }
    // });
//    $("#submitMe").click(function() {
//        $.ajax({
//           type: 'GET',
//           url: "/regupersonil?"+$("#datepicker").val();
//           method: "GET",
        //   data: $('#dateForm').serialize(),
    //       success: function() {
    //         window.open(url);
    //       }
    //    });
    //    return false;
    // })
</script>
@endsection			
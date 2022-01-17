{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')

			<div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Jurnal</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Pergantian Shift</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Laporan Pergantian Shift</h4>
                                <h4 class="card-title"><?php echo date('d-m-Y'); ?></h4>
                            </div>
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                        <ul class="p-0 m-0" style="list-style: none;">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
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
                                                @if (session('statusA'))
                                                    <div class="alert alert-success">
                                                        {{ session('statusA') }}
                                                    </div>
                                                @elseif(session('dangerA'))    
                                                    <div class="alert alert-danger">
                                                        {{ session('dangerA') }}
                                                    </div>
                                                @endif
                                                <!-- MODAL TAMBAH A-->
                                                    @if(in_array('1', $regusArr))
                                                    <button type="button" class="btn btn-primary btn-md mb-2" data-toggle="modal" data-target="#tambahModalA">+ Tambah Lap. Shift</button>
                                                    @endif
                                                    <div class="modal fade bd-example-modal-lg" id="tambahModalA" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tambah Laporan Pergantian Shift</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU A</h3>
                                                                    <form id="form-create-lapshift" name="form-create-lapshift" method="POST" action="{{route('createlapshift')}}">
                                                                        @csrf
                                                                        <input type="hidden" name="regu_id" value="1">
                                                                        <input type="hidden" name="zona_id" value="{{$zonaid}}">
                                                                        <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Pukul</label>
                                                                            <div class="col-sm-9">
                                                                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                    <input name="pukul" type="text" class="form-control" value="00:00"> <span class="input-group-append"><span class="input-group-text">
                                                                                        <i class="fa fa-clock-o"></i></span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Uraian Tugas</label>
                                                                            <div class="col-sm-9">
                                                                                <textarea required maxlength="150" name="uraian_tugas" rows="4" type="text" oninput="" class="form-control" placeholder="Masukkan Uraian Tugas"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-9">
                                                                                <select name="keterangan" class="form-control" id="keterangan">
                                                                                <option value="Aman, Tertib Terkendali">Aman, Tertib Terkendali</option>
                                                                                <option value="Tidak Aman, Perlu Tindakan Lanjutan">Tidak Aman, Perlu Tindakan Lanjutan</option>
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
                                                <!-- MODAL TAMBAH A END -->
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
                                                            @foreach($tugass->where('regu_id','=','1') as $tugas)
                                                            <tr>
                                                                <td><strong>{{$no++}}</strong></td>
                                                                <td>{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}</td>
                                                                <td>{{$tugas->uraian_tugas}}</td>
                                                                <td>{{$tugas->keterangan}}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn btn-primary light sharp" data-toggle="dropdown">
                                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{$tugas->id}}">Edit</a>
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hapusModal{{$tugas->id}}">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE A -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$tugas->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit Laporan Pergantian Shift</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU A</h3>
                                                                                    <form id="form-update-lapshift" name="form-update-lapshift" method="POST" action="/pergantian-shift/{{$tugas->id}}/update">
                                                                                        @csrf
                                                                                        <input type="hidden" name="regu_id" value="{{$tugas->regu_id}}">
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Pukul</label>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                                    <input name="pukul" type="text" class="form-control" value="{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}"> <span class="input-group-append"><span class="input-group-text">
                                                                                                        <i class="fa fa-clock-o"></i></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Uraian Tugas</label>
                                                                                            <div class="col-sm-9">
                                                                                                <textarea required maxlength="150" name="uraian_tugas" rows="4" type="text" oninput="" class="form-control" placeholder="Masukkan Uraian Tugas">{{$tugas->uraian_tugas}}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name="keterangan" class="form-control" id="keterangan">
                                                                                                <option value="Aman, Tertib Terkendali" {{ $tugas->keterangan == 'Aman, Tertib Terkendali' ? 'selected': '' }}>Aman, Tertib Terkendali</option>
                                                                                                <option value="Tidak Aman, Perlu Tindakan Lanjutan" {{ $tugas->keterangan == 'Tidak Aman, Perlu Tindakan Lanjutan' ? 'selected': '' }}>Tidak Aman, Perlu Tindakan Lanjutan</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE A END -->
                                                                    <!--MODAL HAPUS A-->
                                                                    <div class="modal fade" id="hapusModal{{$tugas->id}}">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <div class="alert alert-danger notification">
                                                                                        <p class="notification-title mb-2"><strong>Perhatian! </strong> Yakin akan menghapus?
                                                                                        </p>
                                                                                        <p>Data yang dihapus tidak dapat dikembalikan.</p> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <form method="POST" action="/pergantian-shift/{{$tugas->id}}/destroy">
                                                                                    @csrf
                                                                                        <input type="hidden" name="regu_id" value="1">
                                                                                        <button type="submit" class="btn btn-danger btn-sm">Konfirmasi</button>
                                                                                    </form>
                                                                                    <button class="btn btn-link btn-sm" data-dismiss="modal">Batal</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL HAPUS A END -->
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
                                                @if (session('statusB'))
                                                    <div class="alert alert-success">
                                                        {{ session('statusB') }}
                                                    </div>
                                                @elseif(session('dangerB'))    
                                                    <div class="alert alert-danger">
                                                        {{ session('dangerB') }}
                                                    </div>
                                                @endif
                                                <!-- MODAL TAMBAH B -->
                                                    @if(in_array('2', $regusArr))
                                                    <button type="button" class="btn btn-primary btn-md mb-2" data-toggle="modal" data-target="#tambahModalB">+ Tambah Lap. Shift</button>
                                                    @endif
                                                    <div class="modal fade bd-example-modal-lg" id="tambahModalB" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tambah Laporan Pergantian Shift</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU B</h3>
                                                                    <form id="form-create-lapshift" name="form-create-lapshift" method="POST" action="{{route('createlapshift')}}">
                                                                        @csrf
                                                                        <input type="hidden" name="regu_id" value="2">
                                                                        <input type="hidden" name="zona_id" value="{{$zonaid}}">
                                                                        <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Pukul</label>
                                                                            <div class="col-sm-9">
                                                                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                    <input name="pukul" type="text" class="form-control" value="00:00"> <span class="input-group-append"><span class="input-group-text">
                                                                                        <i class="fa fa-clock-o"></i></span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Uraian Tugas</label>
                                                                            <div class="col-sm-9">
                                                                                <textarea required maxlength="150" name="uraian_tugas" rows="4" type="text" oninput="" class="form-control" placeholder="Masukkan Uraian Tugas"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-9">
                                                                                <select name="keterangan" class="form-control" id="keterangan">
                                                                                <option value="Aman, Tertib Terkendali">Aman, Tertib Terkendali</option>
                                                                                <option value="Tidak Aman, Perlu Tindakan Lanjutan">Tidak Aman, Perlu Tindakan Lanjutan</option>
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
                                                <!-- MODAL TAMBAH B END -->
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
                                                            @foreach($tugass->where('regu_id','=','2') as $tugas)
                                                            <tr>
                                                                <td><strong>{{$no++}}</strong></td>
                                                                <td>{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}</td>
                                                                <td>{{$tugas->uraian_tugas}}</td>
                                                                <td>{{$tugas->keterangan}}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn btn-primary light sharp" data-toggle="dropdown">
                                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{$tugas->id}}">Edit</a>
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hapusModal{{$tugas->id}}">Delete</a>
                                                                        </div>
                                                                        <!-- MODAL UPDATE B -->
                                                                        <div class="modal fade bd-example-modal-lg" id="editModal{{$tugas->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title">Edit Laporan Pergantian Shift</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU B</h3>
                                                                                        <form id="form-update-lapshift" name="form-update-lapshift" method="POST" action="/pergantian-shift/{{$tugas->id}}/update">
                                                                                            @csrf
                                                                                            <input type="hidden" name="regu_id" value="{{$tugas->regu_id}}">
                                                                                            <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Pukul</label>
                                                                                                <div class="col-sm-9">
                                                                                                    <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                                        <input name="pukul" type="text" class="form-control" value="{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}"> <span class="input-group-append"><span class="input-group-text">
                                                                                                            <i class="fa fa-clock-o"></i></span></span>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-sm-3 col-form-label">Uraian Tugas</label>
                                                                                                <div class="col-sm-9">
                                                                                                    <textarea required maxlength="150" name="uraian_tugas" rows="4" type="text" oninput="" class="form-control" placeholder="Masukkan Uraian Tugas">{{$tugas->uraian_tugas}}</textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="form-group row">
                                                                                                <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                                                <div class="col-sm-9">
                                                                                                    <select name="keterangan" class="form-control" id="keterangan">
                                                                                                    <option value="Aman, Tertib Terkendali" {{ $tugas->keterangan == 'Aman, Tertib Terkendali' ? 'selected': '' }}>Aman, Tertib Terkendali</option>
                                                                                                    <option value="Tidak Aman, Perlu Tindakan Lanjutan" {{ $tugas->keterangan == 'Tidak Aman, Perlu Tindakan Lanjutan' ? 'selected': '' }}>Tidak Aman, Perlu Tindakan Lanjutan</option>
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                    </div>
                                                                                            <div class="modal-footer">
                                                                                                <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                                <button type="submit" class="btn btn-primary">Update</button>
                                                                                            </div>
                                                                                        </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- MODAL UPDATE B END -->
                                                                        <!--MODAL HAPUS B-->
                                                                        <div class="modal fade" id="hapusModal{{$tugas->id}}">
                                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-body">
                                                                                        <div class="alert alert-danger notification">
                                                                                            <p class="notification-title mb-2"><strong>Perhatian! </strong> Yakin akan menghapus?
                                                                                            </p>
                                                                                            <p>Data yang dihapus tidak dapat dikembalikan.</p> 
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <form method="POST" action="/pergantian-shift/{{$tugas->id}}/destroy">
                                                                                        @csrf
                                                                                            <input type="hidden" name="regu_id" value="2">
                                                                                            <button type="submit" class="btn btn-danger btn-sm">Konfirmasi</button>
                                                                                        </form>
                                                                                        <button class="btn btn-link btn-sm" data-dismiss="modal">Batal</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- MODAL HAPUS B END -->
                                                                    </div>
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
                                                @if (session('statusC'))
                                                    <div class="alert alert-success">
                                                        {{ session('statusC') }}
                                                    </div>
                                                @elseif(session('dangerC'))    
                                                    <div class="alert alert-danger">
                                                        {{ session('dangerC') }}
                                                    </div>
                                                @endif
                                                <!-- MODAL TAMBAH C -->
                                                    @if(in_array('3', $regusArr))
                                                    <button type="button" class="btn btn-primary btn-md mb-2" data-toggle="modal" data-target="#tambahModalC">+ Tambah Lap. Shift</button>
                                                    @endif
                                                    <div class="modal fade bd-example-modal-lg" id="tambahModalC" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tambah Laporan Pergantian Shift</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU C</h3>
                                                                    <form id="form-create-lapshift" name="form-create-lapshift" method="POST" action="{{route('createlapshift')}}">
                                                                        @csrf
                                                                        <input type="hidden" name="regu_id" value="3">
                                                                        <input type="hidden" name="zona_id" value="{{$zonaid}}">
                                                                        <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Pukul</label>
                                                                            <div class="col-sm-9">
                                                                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                    <input name="pukul" type="text" class="form-control" value="00:00"> <span class="input-group-append"><span class="input-group-text">
                                                                                        <i class="fa fa-clock-o"></i></span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Uraian Tugas</label>
                                                                            <div class="col-sm-9">
                                                                                <textarea required maxlength="150" name="uraian_tugas" rows="4" type="text" oninput="" class="form-control" placeholder="Masukkan Uraian Tugas"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-9">
                                                                                <select name="keterangan" class="form-control" id="keterangan">
                                                                                <option value="Aman, Tertib Terkendali">Aman, Tertib Terkendali</option>
                                                                                <option value="Tidak Aman, Perlu Tindakan Lanjutan">Tidak Aman, Perlu Tindakan Lanjutan</option>
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
                                                <!-- MODAL TAMBAH C END -->
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
                                                            @foreach($tugass->where('regu_id','=','3') as $tugas)
                                                            <tr>
                                                                <td><strong>{{$no++}}</strong></td>
                                                                <td>{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}</td>
                                                                <td>{{$tugas->uraian_tugas}}</td>
                                                                <td>{{$tugas->keterangan}}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn btn-primary light sharp" data-toggle="dropdown">
                                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{$tugas->id}}">Edit</a>
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hapusModal{{$tugas->id}}">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE C -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$tugas->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit Laporan Pergantian Shift</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU C</h3>
                                                                                    <form id="form-update-lapshift" name="form-update-lapshift" method="POST" action="/pergantian-shift/{{$tugas->id}}/update">
                                                                                        @csrf
                                                                                        <input type="hidden" name="regu_id" value="{{$tugas->regu_id}}">
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Pukul</label>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                                    <input name="pukul" type="text" class="form-control" value="{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}"> <span class="input-group-append"><span class="input-group-text">
                                                                                                        <i class="fa fa-clock-o"></i></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Uraian Tugas</label>
                                                                                            <div class="col-sm-9">
                                                                                                <textarea required maxlength="150" name="uraian_tugas" rows="4" type="text" oninput="" class="form-control" placeholder="Masukkan Uraian Tugas">{{$tugas->uraian_tugas}}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name="keterangan" class="form-control" id="keterangan">
                                                                                                <option value="Aman, Tertib Terkendali" {{ $tugas->keterangan == 'Aman, Tertib Terkendali' ? 'selected': '' }}>Aman, Tertib Terkendali</option>
                                                                                                <option value="Tidak Aman, Perlu Tindakan Lanjutan" {{ $tugas->keterangan == 'Tidak Aman, Perlu Tindakan Lanjutan' ? 'selected': '' }}>Tidak Aman, Perlu Tindakan Lanjutan</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE C END -->
                                                                    <!--MODAL HAPUS C-->
                                                                    <div class="modal fade" id="hapusModal{{$tugas->id}}">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <div class="alert alert-danger notification">
                                                                                        <p class="notification-title mb-2"><strong>Perhatian! </strong> Yakin akan menghapus?
                                                                                        </p>
                                                                                        <p>Data yang dihapus tidak dapat dikembalikan.</p> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <form method="POST" action="/pergantian-shift/{{$tugas->id}}/destroy">
                                                                                    @csrf
                                                                                        <input type="hidden" name="regu_id" value="3">
                                                                                        <button type="submit" class="btn btn-danger btn-sm">Konfirmasi</button>
                                                                                    </form>
                                                                                    <button class="btn btn-link btn-sm" data-dismiss="modal">Batal</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL HAPUS C END -->
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
                                                @if (session('statusD'))
                                                    <div class="alert alert-success">
                                                        {{ session('statusD') }}
                                                    </div>
                                                @elseif(session('dangerD'))    
                                                    <div class="alert alert-danger">
                                                        {{ session('dangerD') }}
                                                    </div>
                                                @endif
                                                <!-- MODAL TAMBAH D-->
                                                    @if(in_array('4', $regusArr))
                                                    <button type="button" class="btn btn-primary btn-md mb-2" data-toggle="modal" data-target="#tambahModalD">+ Tambah Lap. Shift</button>
                                                    @endif
                                                    <div class="modal fade bd-example-modal-lg" id="tambahModalD" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tambah Laporan Pergantian Shift</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU D</h3>
                                                                    <form id="form-create-lapshift" name="form-create-lapshift" method="POST" action="{{route('createlapshift')}}">
                                                                        @csrf
                                                                        <input type="hidden" name="regu_id" value="4">
                                                                        <input type="hidden" name="zona_id" value="{{$zonaid}}">
                                                                        <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Pukul</label>
                                                                            <div class="col-sm-9">
                                                                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                    <input name="pukul" type="text" class="form-control" value=""> <span class="input-group-append"><span class="input-group-text">
                                                                                        <i class="fa fa-clock-o"></i></span></span>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Uraian Tugas</label>
                                                                            <div class="col-sm-9">
                                                                                <textarea required maxlength="150" name="uraian_tugas" rows="4" type="text" oninput="" class="form-control" placeholder="Masukkan Uraian Tugas"></textarea>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-9">
                                                                                <select name="keterangan" class="form-control" id="keterangan">
                                                                                <option value="Aman, Tertib Terkendali">Aman, Tertib Terkendali</option>
                                                                                <option value="Tidak Aman, Perlu Tindakan Lanjutan">Tidak Aman, Perlu Tindakan Lanjutan</option>
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
                                                <!-- MODAL TAMBAH D END -->
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
                                                            @foreach($tugass->where('regu_id','=','4') as $tugas)
                                                            <tr>
                                                                <td><strong>{{$no++}}</strong></td>
                                                                <td>{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}</td>
                                                                <td>{{$tugas->uraian_tugas}}</td>
                                                                <td>{{$tugas->keterangan}}</td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn btn-primary light sharp" data-toggle="dropdown">
                                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{$tugas->id}}">Edit</a>
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hapusModal{{$tugas->id}}">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE D -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$tugas->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit Laporan Pergantian Shift</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU D</h3>
                                                                                    <form id="form-update-lapshift" name="form-update-lapshift" method="POST" action="/pergantian-shift/{{$tugas->id}}/update">
                                                                                        @csrf
                                                                                        <input type="hidden" name="regu_id" value="{{$tugas->regu_id}}">
                                                                                        <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Pukul</label>
                                                                                            <div class="col-sm-9">
                                                                                                <div class="input-group clockpicker" data-placement="bottom" data-align="top" data-autoclose="true">
                                                                                                    <input name="pukul" type="text" class="form-control" value="{{\Carbon\Carbon::parse($tugas->pukul)->format('H:i')}}"> <span class="input-group-append"><span class="input-group-text">
                                                                                                        <i class="fa fa-clock-o"></i></span></span>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Uraian Tugas</label>
                                                                                            <div class="col-sm-9">
                                                                                                <textarea required maxlength="150" name="uraian_tugas" rows="4" type="text" oninput="" class="form-control" placeholder="Masukkan Uraian Tugas">{{$tugas->uraian_tugas}}</textarea>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="form-group row">
                                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                                            <div class="col-sm-9">
                                                                                                <select name="keterangan" class="form-control" id="keterangan">
                                                                                                <option value="Aman, Tertib Terkendali" {{ $tugas->keterangan == 'Aman, Tertib Terkendali' ? 'selected': '' }}>Aman, Tertib Terkendali</option>
                                                                                                <option value="Tidak Aman, Perlu Tindakan Lanjutan" {{ $tugas->keterangan == 'Tidak Aman, Perlu Tindakan Lanjutan' ? 'selected': '' }}>Tidak Aman, Perlu Tindakan Lanjutan</option>
                                                                                                </select>
                                                                                            </div>
                                                                                        </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <button type="submit" class="btn btn-primary">Update</button>
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE D END -->
                                                                    <!--MODAL HAPUS D-->
                                                                    <div class="modal fade" id="hapusModal{{$tugas->id}}">
                                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                                            <div class="modal-content">
                                                                                <div class="modal-body">
                                                                                    <div class="alert alert-danger notification">
                                                                                        <p class="notification-title mb-2"><strong>Perhatian! </strong> Yakin akan menghapus?
                                                                                        </p>
                                                                                        <p>Data yang dihapus tidak dapat dikembalikan.</p> 
                                                                                    </div>
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <form method="POST" action="/pergantian-shift/{{$tugas->id}}/destroy">
                                                                                    @csrf
                                                                                        <input type="hidden" name="regu_id" value="4">
                                                                                        <button type="submit" class="btn btn-danger btn-sm">Konfirmasi</button>
                                                                                    </form>
                                                                                    <button class="btn btn-link btn-sm" data-dismiss="modal">Batal</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL HAPUS D END -->
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
        $('#tabMenu a[href="#{{ old('tab') }}"]').tab('show')
    });
</script>
@endsection
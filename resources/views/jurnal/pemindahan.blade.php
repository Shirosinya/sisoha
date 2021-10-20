{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')

			<div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="javascript:void(0)">Jurnal</a></li>
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Pemindahan</a></li>
					</ol>
                </div>
                <!-- row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Pemindahan</h4>
                                <h4 class="card-title"><?php echo date('d-m-Y'); ?></h4>
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
                                                @if (session('statusA'))
                                                    <div class="alert alert-success">
                                                        {{ session('statusA') }}
                                                    </div>
                                                @endif
                                                <!-- MODAL TAMBAH A-->
                                                    <button type="button" class="btn btn-primary btn-md mb-2" data-toggle="modal" data-target="#tambahModalA">+ Tambah Data</button>
                                                    <div class="modal fade bd-example-modal-lg" id="tambahModalA" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tambah Pemindahan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU A</h3>
                                                                    <form id="form-create-pemindahan" name="form-create-pemindahan" method="POST" action="{{route('createpemindahan')}}">
                                                                        @csrf
                                                                        <input type="hidden" name="regu_id" value="1">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Pemindahan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="nama_pemindahan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama pemindahan.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Gudang</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="gudang" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama gudang.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Tujuan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="tujuan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama tujuan.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Armada</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="armada" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama armada.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="keterangan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Keterangan.."></input>
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
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn btn-primary light sharp" data-toggle="dropdown">
                                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{$pemindahan->id}}">Edit</a>
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hapusModal{{$pemindahan->id}}">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE A -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$pemindahan->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit pemindahan</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU A</h3>
                                                                                    <form id="form-update-pemindahan" name="form-update-pemindahan" method="POST" action="/pemindahan/{{$pemindahan->id}}/update">
                                                                                    @csrf
                                                                                    <input type="hidden" name="regu_id" value="1">
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Pemindahan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="nama_pemindahan" value="{{$pemindahan->nama_pemindahan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama pemindahan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Gudang</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="gudang" value="{{$pemindahan->gudang}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama gudang.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Tujuan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="tujuan" value="{{$pemindahan->tujuan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama tujuan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Armada</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="armada" value="{{$pemindahan->armada}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama armada.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="keterangan" value="{{$pemindahan->keterangan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Keterangan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                            </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                        <button type="submit" class="btn btn-primary">Ubah</button>
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE A END -->
                                                                    <!--MODAL HAPUS A-->
                                                                    <div class="modal fade" id="hapusModal{{$pemindahan->id}}">
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
                                                                                    <form method="POST" action="/pemindahan/{{$pemindahan->id}}/destroy">
                                                                                    @csrf
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
                                                @endif
                                                <!-- MODAL TAMBAH B -->
                                                    <button type="button" class="btn btn-primary btn-md mb-2" data-toggle="modal" data-target="#tambahModalB">+ Tambah Data</button>
                                                    <div class="modal fade bd-example-modal-lg" id="tambahModalB" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tambah Pemindahan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU B</h3>
                                                                    <form id="form-create-pemindahan" name="form-create-pemindahan" method="POST" action="{{route('createpemindahan')}}">
                                                                        @csrf
                                                                        <input type="hidden" name="regu_id" value="2">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Pemindahan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="nama_pemindahan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama pemindahan.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Gudang</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="gudang" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama gudang.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Tujuan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="tujuan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama tujuan.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Armada</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="armada" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama armada.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="keterangan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Keterangan.."></input>
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
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn btn-primary light sharp" data-toggle="dropdown">
                                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{$pemindahan->id}}">Edit</a>
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hapusModal{{$pemindahan->id}}">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                        <!-- MODAL UPDATE B -->
                                                                        <div class="modal fade bd-example-modal-lg" id="editModal{{$pemindahan->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                            <div class="modal-dialog modal-lg">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title">Edit pemindahan</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU B</h3>
                                                                                        <form id="form-update-pemindahan" name="form-update-pemindahan" method="POST" action="/pemindahan/{{$pemindahan->id}}/update">
                                                                                        @csrf
                                                                                        <input type="hidden" name="regu_id" value="2">
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Pemindahan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="nama_pemindahan" value="{{$pemindahan->nama_pemindahan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama pemindahan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Gudang</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="gudang" value="{{$pemindahan->gudang}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama gudang.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Tujuan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="tujuan" value="{{$pemindahan->tujuan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama tujuan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Armada</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="armada" value="{{$pemindahan->armada}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama armada.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="keterangan" value="{{$pemindahan->keterangan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Keterangan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                                                                        </div>
                                                                                    </form>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <!-- MODAL UPDATE B END -->
                                                                        <!--MODAL HAPUS B-->
                                                                        <div class="modal fade" id="hapusModal{{$pemindahan->id}}">
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
                                                                                        <form method="POST" action="/pemindahan/{{$pemindahan->id}}/destroy">
                                                                                        @csrf
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
                                                @endif
                                                <!-- MODAL TAMBAH C -->
                                                    <button type="button" class="btn btn-primary btn-md mb-2" data-toggle="modal" data-target="#tambahModalC">+ Tambah Data</button>
                                                    <div class="modal fade bd-example-modal-lg" id="tambahModalC" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tambah Pemindahan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU C</h3>
                                                                    <form id="form-create-pemindahan" name="form-create-pemindahan" method="POST" action="{{route('createpemindahan')}}">
                                                                        @csrf
                                                                        <input type="hidden" name="regu_id" value="3">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Pemindahan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="nama_pemindahan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama pemindahan.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Gudang</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="gudang" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama gudang.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Tujuan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="tujuan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama tujuan.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Armada</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="armada" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama armada.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="keterangan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Keterangan.."></input>
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
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn btn-primary light sharp" data-toggle="dropdown">
                                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{$pemindahan->id}}">Edit</a>
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hapusModal{{$pemindahan->id}}">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE C -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$pemindahan->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit pemindahan</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU C</h3>
                                                                                    <form id="form-update-pemindahan" name="form-update-pemindahan" method="POST" action="/pemindahan/{{$pemindahan->id}}/update">
                                                                                        @csrf
                                                                                        <input type="hidden" name="regu_id" value="3">
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Pemindahan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="nama_pemindahan" value="{{$pemindahan->nama_pemindahan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama pemindahan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Gudang</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="gudang" value="{{$pemindahan->gudang}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama gudang.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Tujuan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="tujuan" value="{{$pemindahan->tujuan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama tujuan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Armada</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="armada" value="{{$pemindahan->armada}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama armada.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="keterangan" value="{{$pemindahan->keterangan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Keterangan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE C END -->
                                                                    <!--MODAL HAPUS C-->
                                                                    <div class="modal fade" id="hapusModal{{$pemindahan->id}}">
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
                                                                                    <form method="POST" action="/pemindahan/{{$pemindahan->id}}/destroy">
                                                                                    @csrf
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
                                                @endif
                                                <!-- MODAL TAMBAH D-->
                                                    <button type="button" class="btn btn-primary btn-md mb-2" data-toggle="modal" data-target="#tambahModalD">+ Tambah Data</button>
                                                    <div class="modal fade bd-example-modal-lg" id="tambahModalD" tabindex="-1" role="dialog" aria-hidden="true">
                                                        <div class="modal-dialog modal-lg">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">Tambah Pemindahan</h5>
                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU D</h3>
                                                                    <form id="form-create-pemindahan" name="form-create-pemindahan" method="POST" action="{{route('createpemindahan')}}">
                                                                        @csrf
                                                                        <input type="hidden" name="regu_id" value="4">
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Pemindahan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="nama_pemindahan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama pemindahan.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Gudang</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="gudang" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama gudang.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Tujuan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="tujuan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama tujuan.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Armada</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="armada" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama armada.."></input>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group row">
                                                                            <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                            <div class="col-sm-9">
                                                                                <input required name="keterangan" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Keterangan.."></input>
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
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn btn-primary light sharp" data-toggle="dropdown">
                                                                            <svg width="20px" height="20px" viewBox="0 0 24 24" version="1.1"><g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd"><rect x="0" y="0" width="24" height="24"/><circle fill="#000000" cx="5" cy="12" r="2"/><circle fill="#000000" cx="12" cy="12" r="2"/><circle fill="#000000" cx="19" cy="12" r="2"/></g></svg>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editModal{{$pemindahan->id}}">Edit</a>
                                                                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#hapusModal{{$pemindahan->id}}">Delete</a>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE D -->
                                                                    <div class="modal fade bd-example-modal-lg" id="editModal{{$pemindahan->id}}" tabindex="-1" role="dialog" aria-hidden="true">
                                                                        <div class="modal-dialog modal-lg">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title">Edit pemindahan</h5>
                                                                                    <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                                    </button>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    <h3 style="margin-top:-15px; margin-bottom:15px;" >REGU D</h3>
                                                                                    <form id="form-update-pemindahan" name="form-update-pemindahan" method="POST" action="/pemindahan/{{$pemindahan->id}}/update">
                                                                                        @csrf
                                                                                        <input type="hidden" name="regu_id" value="4">
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Pemindahan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="nama_pemindahan" value="{{$pemindahan->nama_pemindahan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama pemindahan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Gudang</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="gudang" value="{{$pemindahan->gudang}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama gudang.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Tujuan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="tujuan" value="{{$pemindahan->tujuan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama tujuan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Armada</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="armada" value="{{$pemindahan->armada}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Masukkan nama armada.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group row">
                                                                                        <label class="col-sm-3 col-form-label">Keterangan</label>
                                                                                        <div class="col-sm-9">
                                                                                            <input required name="keterangan" value="{{$pemindahan->keterangan}}" type="text" oninput="this.value = this.value.toUpperCase()" class="form-control" placeholder="Keterangan.."></input>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
                                                                                            <button type="submit" class="btn btn-primary">Ubah</button>
                                                                                        </div>
                                                                                    </form>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <!-- MODAL UPDATE D END -->
                                                                    <!--MODAL HAPUS D-->
                                                                    <div class="modal fade" id="hapusModal{{$pemindahan->id}}">
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
                                                                                    <form method="POST" action="/pemindahan/{{$pemindahan->id}}/destroy">
                                                                                    @csrf
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
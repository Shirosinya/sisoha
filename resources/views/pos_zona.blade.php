{{-- Extends layout --}}
@extends('layout.default')



{{-- Content --}}
@section('content')
<div class="container-fluid">
                <div class="page-titles">
					<ol class="breadcrumb">
						<li class="breadcrumb-item active"><a href="javascript:void(0)">Pos Zona</a></li>
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
                        <div class="card">
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
                                <!-- Nav tabs -->
                                <div class="pt-4">
                                    <div class="table-responsive">
                                        <!-- MODAL TAMBAH -->
                                        <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#tambahModal">+ Tambah Pos Zona</button>
                                        <div class="modal fade bd-example-modal-lg" id="tambahModal" tabindex="-1" role="dialog" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title">Tambah Pos Zona</h5>
                                                        <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form id="form-create-pos-zona" name="form-create-pos-zona" method="POST" action="{{route('createpos-zona')}}">
                                                            @csrf
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Nama Pos</label>
                                                                <div class="col-sm-9">
                                                                    <input required name="nama_pos" value="" type="text" class="form-control" placeholder="Masukkan nama pos..">
                                                                </div>
                                                            </div>
                                                            <div class="form-group row">
                                                                <label class="col-sm-3 col-form-label">Keterangan (opsional)</label>
                                                                <div class="col-sm-9">
                                                                    <textarea name="keterangan" row="4" class="form-control" placeholder="Masukkan keterangan pos.."></textarea>
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
                                        <table id="example" class="display min-w850">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nama Pos</th>
                                                    <th>Keterangan</th>
                                                    <th>Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                            <?php $i = 1;?>
                                            @foreach($poss as $value )
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$value->nama_pos}}</td>
                                                    <td>{{$value->keterangan}}</td>
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
                                                                <h5 class="modal-title">Update Data Pos Zona</h5>
                                                                <button type="button" class="close" data-dismiss="modal"><span>&times;</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form id="form-update-pos" name="form-update-pos" method="POST" action="/pos-zona/{{$value->id}}/update">
                                                                    @csrf
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Nama</label>
                                                                        <div class="col-sm-9">
                                                                            <input name="nama_pos" value="{{ $value->nama_pos }}" type="text" class="form-control" placeholder="Masukkan nama pos..">
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group row">
                                                                        <label class="col-sm-3 col-form-label">Keterangan (opsional)</label>
                                                                        <div class="col-sm-9">
                                                                            <textarea name="keterangan" row="4" class="form-control" placeholder="Masukkan keterangan pos..">{{$value->keterangan}}</textarea>
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
                                                                    <form method="POST" action="/pos-zona/{{$value->id}}/destroy">
                                                                    @csrf
                                                                        <button type="submit" class="btn btn-danger btn-sm">Konfirmasi</button>
                                                                    </form>
                                                                    <button class="btn btn-link btn-sm" data-dismiss="modal">Batal</button>
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
                </div>
</div>
@endsection			
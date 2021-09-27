@section('modal-edit-body')
<div class="modal-body modalBody">
    <form method="POST" action="">
        @csrf
        <div class="form-group row">
            <label class="col-sm-3 col-form-label">Nama</label>
            <div class="col-sm-9">
                <input name="nama" value="" type="text" class="form-control" placeholder="Masukkan Nama Personil">
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
                <select name="regu" class="form-control" id="sel1">
                <option value="1">Regu A</option>
                <option value="2">Regu B</option>
                <option value="3">Regu C</option>
                <option value="4">Regu D</option>
                </select>
            </div>
        </div>
    
</div>
@endsection
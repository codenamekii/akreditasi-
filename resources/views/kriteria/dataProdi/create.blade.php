@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
    <a href="{{ route('dataprodi.semua') }}" class="btn btn-primary mb-2 mb-md-0 mr-2">kelola program studi</a>

    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Menu Akun</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">Data program studi</p>
        </a>
      </div>
    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Tambah Data Program Studi</h4>
          <form class="forms-sample" action="{{ isset($dataProdi) ? route('dataprodi.updateByFakutlas', Crypt::encryptString($dataProdi->id)) : route('dataprodi.store')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="id">Kode Program Studi</label>
              <input type="text" class="form-control @error('id') is-invalid @enderror" id="id" name="id" value="{{ old('id', isset($dataProdi) ? $dataProdi->id : '') }}" placeholder="Kode Program Studi" @if(isset($dataProdi)) disabled @endif>
              <small class="form-text text-muted">Note: Kode Program Studi tidak dapat diubah.</small>
              @error('id')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <div class="form-group">
              <label for="nama">Nama Program Studi</label>
              <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', isset($dataProdi) ? $dataProdi->nama : '') }}" placeholder="Nama Program Studi">
              @error('nama')
              <div class="invalid-feedback">{{ $message }}</div>
              @enderror
            </div>
            <button type="submit" class="btn btn-primary mr-2" onclick="this.disabled=true;this.form.submit();">{{ isset($dataProdi) ? 'Update' : 'Submit' }}</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- last row starts here -->

</div>
@endsection


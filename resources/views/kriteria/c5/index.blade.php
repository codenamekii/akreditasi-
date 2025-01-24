@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <!-- <button class="btn btn-primary mb-2 mb-md-0 mr-2"> Tambah data </button> -->
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Data Kuantitatif</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">K.5 Keuangan, Sarana, dan Prasarana</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Pemerolehan Dana</h5>
          <a href="/kriteria5/pemerolehan_dana" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Penggunaan Dana</h5>
          <a href="/kriteria5/penggunaan_dana" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Dana Penelitian</h5>
          <a href="/kriteria5/dana_penelitian" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Dana PkM</h5>
          <a href="/kriteria5/dana_pkm" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Data Prasarana Pendidikan</h5>
          <a href="/kriteria5/prasarana_pendidikan" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Data Sarana Pendidikan</h5>
          <a href="kriteria5/sarana_pendidikan" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>

  </div>
  <!-- last row starts here -->

</div>
@endsection

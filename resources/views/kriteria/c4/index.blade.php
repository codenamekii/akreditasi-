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
          <p class="m-0">K.4 Sumber Daya Manusia</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">DTPS yang Bidang Keahliannya Sesuai dengan Bidang PS</h5>
          <a href="/kriteria4/dtps_keahlian_bidang_ps" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">DTPS yang Bidang Keahliannya di Luar Bidang PS </h5>
          <a href="/kriteria4/dtps_luar_ps" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Rasio DTPS terhadap Mahasiswa Reguler</h5>
          <a href="/kriteria4/rasio_dtps_terhadap_mahasiswa_reguler/index" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Beban Kerja Dosen DTPS</h5>
          <a href="/kriteria4/beban_kerja_dosen_dtps" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"> Kegiatan Mengajar Dosen Tetap</h5>
          <a href="/kriteria4/kegiatan_mengajar_dosen_tetap" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title"> Jumlah Bimbingan Tugas Akhir atau Skripsi, Tesis, dan Disertasi</h5>
          <a href="/kriteria4/jumlah_bimbingan_ta" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Prestasi DTPS</h5>
          <a href="/kriteria4/prestasi_dtps" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pengembangan Kompetensi DTPS</h5>
          <a href="/kriteria4/pengembangan_kompetensi_dtps" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Profil Tendik</h5>
          <a href="/kriteria4/profil_tendik" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Pengembangan Kompetensi dan Karier Tendik</h5>
          <a href="/kriteria4/kompetensi_tendik" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>

  </div>
  <!-- last row starts here -->

</div>
@endsection

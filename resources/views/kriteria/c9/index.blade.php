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
          <p class="m-0">K.9 Luaran dan Capaian Tridharma</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel IPK Lulusan</h5>
          <a href="{{route('ipk_lulusan.index')}} " class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Prestasi Mahasiswa</h5>
          <a href="{{route('prestasi_mahasiswa.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Masa Studi, Kelulusan Tepat Waktu, dan Keberhasilan Studi</h5>
          <a href="{{route('masa_studi_kelulusan_tepat_waktu_dan_keberhasilan_studi.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Tracer Study, Waktu Tunggu Mendapatkan Pekerjaan Pertama</h5>
          <a href="{{route('tracer_study_waktu_tunggu_mendapatkan_pekerjaan_pertama.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Tingkat Relevansi Pekerjaan</h5>
          <a href="{{route('tingkat_relevansi_pekerjaan.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Tingkat Kepuasan Pengguna Lulusan</h5>
          <a href="{{route('tingkat_kepuasan_pengguna_lulusan.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Publikasi DTPS dan Mahasiswa</h5>
          <a href="{{route('publikasi_dtps_dan_mahasiswa.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Karya Ilmiah DTPS dan Mahasiswa yang Disitasi</h5>
          <a href="{{route('karya_ilmiah_dtps_dan_mahasiswa_yang_disitasi.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Produk atau Jasa DTPS dan Mahasiswa yang Diadopsi oleh Masyarakat</h5>
          <a href="{{route('produk_atau_jasa_dtps_dan_mahasiswa_yang_diadopsi_oleh_masyarakat.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Produk atau Jasa DTPS dan Mahasiswa yang Ber-HKI atau Paten</h5>
          <a href="{{route('produk_atau_jasa_dtps_dan_mahasiswa_yang_berhki_atau_paten.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>

  </div>
  <!-- last row starts here -->

</div>
@endsection

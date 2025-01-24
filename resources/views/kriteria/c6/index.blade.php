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
          <p class="m-0">C.6 Pendidikan</p>
        </a>
      </div>

    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Mata Kuliah, CPL, dan Perangkat Pembelajaran</h5>
          <a href="{{route('mata_kuliah_cpl_dan_perangkat_pembelajaran.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Integrasi Hasil Penelitian dan PkM dalam Proses Pembelajaran</h5>
          <a href="{{route('integrasi_pembelajaran.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Jumlah Mahasiswa Bimbingan dan Frekuensi Pertemuan</h5>
          <a href="{{route('jumlah_mahasiswa_bimbingan_dan_frekuensi_pertemuan.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Jumlah Mahasiswa Bimbingan Magang Kependidikan dan Frekuensi Pertemuan</h5>
          <a href="{{route('jumlah_mahasiswa_bimbingan_magang_kependidikan_dan_frekuensi_pertemuan.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Jumlah Mahasiswa Bimbingan Tugas Akhir atau Skripsi dan Frekuensi Pertemuan</h5>
          <a href="{{route('jumlah_mahasiswa_bimbingan_ta.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Kegiatan Akademik di Luar Perkuliahan</h5>
          <a href="{{route('kegiatan_akademik_di_luar_perkuliahan.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Dosen Tamu dan Tenaga Ahli</h5>
          <a href="{{route('dosen_tamu_dan_tenaga_ahli.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>
    <div class="col-lg-4 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Tabel Kepuasan Mahasiswa</h5>
          <a href="{{route('kepuasan_mahasiswa.index')}}" class="btn btn-primary">Go</a>
        </div>
      </div>
    </div>

  </div>
  <!-- last row starts here -->

</div>
@endsection

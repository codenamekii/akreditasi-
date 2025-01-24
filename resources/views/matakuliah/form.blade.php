@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{ route('matakuliah.index') }}" class="btn btn-outline-primary mb-2 mb-md-0 mr-2">Kelola matakuliah</a>
      <!-- Tempat untuk notifikasi -->
      
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3">Master data</p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <p class="m-0">Matakuliah</p>
                </a>
            </div>
        </div>
  </div>

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      
      <form class="card" action="{{ isset($matakuliah) ? route('matakuliah.update', $matakuliah->id) : route('matakuliah.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($matakuliah))
          @method('PUT')
        @endif
        <div class="card-body">
          <h4 class="card-title">{{ isset($matakuliah) ? 'Perbaharui Matakuliah' : 'Tambah Matakuliah Baru' }}</h4>
          
          @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>Gagal!</strong> {{ session('danger') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong>Berhasil!</strong> {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif 

      
          <div class="form-group">
            <label for="kode_mk">Kode MK</label>
            <input type="text" class="form-control @error('kode_mk') is-invalid @enderror" id="kode_mk" name="kode_mk" placeholder="Masukkan kode MK" value="{{ old('kode_mk', isset($matakuliah) ? $matakuliah->kode_mk : '') }}">
            @error('kode_mk')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama" value="{{ old('nama', isset($matakuliah) ? $matakuliah->nama : '') }}">
            @error('nama')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="sks">SKS</label>
            <input type="number" class="form-control @error('sks') is-invalid @enderror" id="sks" name="sks" placeholder="Masukkan SKS" value="{{ old('sks', isset($matakuliah) ? $matakuliah->sks : '') }}">
            @error('sks')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="semester">Semester</label>
            <input type="number" class="form-control @error('semester') is-invalid @enderror" id="semester" name="semester" placeholder="Masukkan semester" value="{{ old('semester', isset($matakuliah) ? $matakuliah->semester : '') }}">
            @error('semester')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="jenis_matakuliah">Jenis Matakuliah</label>
            <select class="form-control @error('jenis_matakuliah') is-invalid @enderror" id="jenis_matakuliah" name="jenis_matakuliah">
              <option value="">Pilih Jenis Matakuliah</option>
              <option value="teori" {{ old('jenis_matakuliah', isset($matakuliah) ? $matakuliah->jenis_matakuliah : '') == 'teori' ? 'selected' : '' }}>Teori</option>
              <option value="praktikum" {{ old('jenis_matakuliah', isset($matakuliah) ? $matakuliah->jenis_matakuliah : '') == 'praktikum' ? 'selected' : '' }}>Praktikum</option>
              <option value="praktik" {{ old('jenis_matakuliah', isset($matakuliah) ? $matakuliah->jenis_matakuliah : '') == 'praktik' ? 'selected' : '' }}>Praktik</option>
            </select>
            @error('jenis_matakuliah')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>

          <div class="form-group">
            <label for="unit_penyelenggara">Unit Penyelenggara</label>
            <select class="form-control @error('unit_penyelenggara') is-invalid @enderror" id="unit_penyelenggara" name="unit_penyelenggara">
              <option value="">Pilih Unit Penyelenggara</option>
              <option value="pt" {{ old('unit_penyelenggara', isset($matakuliah) ? $matakuliah->unit_penyelenggara : '') == 'pt' ? 'selected' : '' }}>PT</option>
              <option value="upps" {{ old('unit_penyelenggara', isset($matakuliah) ? $matakuliah->unit_penyelenggara : '') == 'upps' ? 'selected' : '' }}>UPPS</option>
              <option value="ps" {{ old('unit_penyelenggara', isset($matakuliah) ? $matakuliah->unit_penyelenggara : '') == 'ps' ? 'selected' : '' }}>PS</option>
            </select>
            @error('unit_penyelenggara')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="kesesuaian_cpl">Kesesuaian CPL</label>
            <select class="form-control @error('kesesuaian_cpl') is-invalid @enderror" id="kesesuaian_cpl" name="kesesuaian_cpl">
              <option value="">Pilih Kesesuaian CPL</option>
              <option value="ya" {{ old('kesesuaian_cpl', isset($matakuliah) ? $matakuliah->kesesuaian_cpl : '') == 'ya' ? 'selected' : '' }}>Ya</option>
              <option value="tidak" {{ old('kesesuaian_cpl', isset($matakuliah) ? $matakuliah->kesesuaian_cpl : '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
            @error('kesesuaian_cpl')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="perangkat_pembelajaran">Perangkat Pembelajaran</label>
            <select class="form-control @error('perangkat_pembelajaran') is-invalid @enderror" id="perangkat_pembelajaran" name="perangkat_pembelajaran">
              <option value="">Pilih Adanya Perangkat Pembelajaran</option>
              <option value="ada" {{ old('perangkat_pembelajaran', isset($matakuliah) ? $matakuliah->perangkat_pembelajaran : '') == 'ada' ? 'selected' : '' }}>Ada</option>
              <option value="tidak" {{ old('perangkat_pembelajaran', isset($matakuliah) ? $matakuliah->perangkat_pembelajaran : '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
            @error('perangkat_pembelajaran')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';">{{ isset($matakuliah) ? 'Simpan Perubahan' : 'Tambah Matakuliah' }}</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type="submit"]');
    const originalButtonHtml = submitButton.innerHTML; // Menyimpan teks asli tombol

    form.onsubmit = function() {
      submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengunggah...';
      submitButton.disabled = true;
    };
  });

  function togglePasswordVisibility() {
    const passwordInput = document.getElementById('password');
    if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
    } else {
      passwordInput.type = 'password';
    }
  }
</script>
@endsection


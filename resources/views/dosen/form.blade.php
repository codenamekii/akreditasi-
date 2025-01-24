@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <a href="{{ route('dosen.index') }}" class="btn btn-outline-primary mb-2 mb-md-0 mr-2">Kelola akun dosen</a>
      <!-- Tempat untuk notifikasi -->
      
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3">Master data</p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <p class="m-0">Dosen yang Sudah Terdaftar</p>
                </a>
            </div>
        </div>
  </div>

  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      
      <form class="card" action="{{ isset($dosen) ? route('dosen.update', $dosen->id) : route('dosen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($dosen))
          @method('PUT')
        @endif
        <div class="card-body">
          <h4 class="card-title">{{ isset($dosen) ? 'Perbaharui Profil Dosen' : 'Tambah Profil Dosen Baru' }}</h4>
          @if(session('danger'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <strong>gagal!</strong> {{ session('danger') }}
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
            <label for="nidn_nidk">NIDN/NUPTK</label>
            <input type="text" class="form-control @error('nidn_nidk') is-invalid @enderror" id="nidn_nidk" name="nidn_nidk" placeholder="Masukkan NIDN/NUPTK" value="{{ old('nidn_nidk', isset($dosen) ? $dosen->nidn_nidk : '') }}">
            @error('nidn_nidk')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="nama">Nama</label>
            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" placeholder="Masukkan nama" value="{{ old('nama', isset($dosen) ? $dosen->nama : '') }}">
            @error('nama')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="tanggal_lahir">Tanggal Lahir</label>
            <input type="date" class="form-control @error('tanggal_lahir') is-invalid @enderror" id="tanggal_lahir" name="tanggal_lahir" placeholder="Masukkan tanggal lahir" value="{{ old('tanggal_lahir', isset($dosen) ? $dosen->tanggal_lahir : '') }}">
            @error('tanggal_lahir')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="sertifikat_pendidik">Sertifikat/Pendidik</label>
            <input type="text" class="form-control @error('sertifikat_pendidik') is-invalid @enderror" id="sertifikat_pendidik" name="sertifikat_pendidik" placeholder="Masukkan sertifikat/pendidik" value="{{ old('sertifikat_pendidik', isset($dosen) ? $dosen->sertifikat_pendidik : '') }}">
            @error('sertifikat_pendidik')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="jabatan_fungsional">Jabatan Fungsional</label>
            <input type="text" class="form-control @error('jabatan_fungsional') is-invalid @enderror" id="jabatan_fungsional" name="jabatan_fungsional" placeholder="Masukkan jabatan fungsional" value="{{ old('jabatan_fungsional', isset($dosen) ? $dosen->jabatan_fungsional : '') }}">
            @error('jabatan_fungsional')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="gelar_akademik">Gelar Akademik</label>
            <input type="text" class="form-control @error('gelar_akademik') is-invalid @enderror" id="gelar_akademik" name="gelar_akademik" placeholder="Masukkan gelar akademik" value="{{ old('gelar_akademik', isset($dosen) ? $dosen->gelar_akademik : '') }}">
            @error('gelar_akademik')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="pendidikan">Pendidik</label>
            <input type="text" class="form-control @error('pendidikan') is-invalid @enderror" id="pendidikan" name="pendidikan" placeholder="Masukkan pendidikan" value="{{ old('pendidikan', isset($dosen) ? $dosen->pendidikan : '') }}">
            @error('pendidikan')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="bidang_keahlian">Bidang Keahlian</label>
            <input type="text" class="form-control @error('bidang_keahlian') is-invalid @enderror" id="bidang_keahlian" name="bidang_keahlian" placeholder="Masukkan bidang keahlian" value="{{ old('bidang_keahlian', isset($dosen) ? $dosen->bidang_keahlian : '') }}">
            @error('bidang_keahlian')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="sesuai_ps">Sesuai PS</label>
            <select class="form-control @error('sesuai_ps') is-invalid @enderror" id="sesuai_ps" name="sesuai_ps">
              <option value="" {{ old('sesuai_ps', isset($dosen) ? $dosen->sesuai_ps : '') == '' ? 'selected' : '' }}>Pilih</option>
              <option value="ya" {{ old('sesuai_ps', isset($dosen) ? $dosen->sesuai_ps : '') == 'ya' ? 'selected' : '' }}>Ya</option>
              <option value="tidak" {{ old('sesuai_ps', isset($dosen) ? $dosen->sesuai_ps : '') == 'tidak' ? 'selected' : '' }}>Tidak</option>
            </select>
            @error('sesuai_ps')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group">
            <label for="tautan">Tautan Link</label>
            <input type="text" class="form-control @error('tautan') is-invalid @enderror" id="tautan" name="tautan" placeholder="Masukkan tautan link" value="{{ old('tautan', isset($dosen) ? $dosen->tautan : '') }}">
            @error('tautan')
              <small class="form-text text-danger">{{ $message }}</small>
            @enderror
          </div>
          <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';">{{ isset($dosen) ? 'Simpan Perubahan' : 'Tambah akun' }}</button>
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


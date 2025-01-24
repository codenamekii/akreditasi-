@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
            <div class="d-flex align-items-center">
                <a href="#">
                    <p class="m-0 pr-3">Akun</p>
                </a>
                <a class="pl-3 mr-4" href="#">
                    <p class="m-0">Akun Pengguna</p>
                </a>
            </div>
        </div>
  </div>

  <div class="row">
<div class="col-lg-12 grid-margin stretch-card">
            <form class="card" action="{{ route('akun.profil.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success alert-dismissible flex-grow-1 mr-3 mb-3" role="alert">
                            <div class="d-flex w-100">
                                <div class="mr-auto">{{ session('success') }}</div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    @endif
          <h4 class="card-title">{{ isset($user) ? 'Perbaharui Akun' : 'Tambah Akun Baru' }}</h4>
          <div class="form-group">
            <label for="name">Nama</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Masukkan nama" autofocus value="{{ old('name', isset($user) ? $user->name : '') }}">
            @error('name')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan email" autofocus value="{{ isset($user) ? $user->email : old('email') }}" >
            @error('email')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="role">Role</label>
            <select class="form-control" id="role" name="role" disabled>
              <option value="">Pilih role</option>
              <option value="admin prodi" {{ old('role', isset($user) ? $user->role : '') == 'admin prodi' ? 'selected' : '' }}>Admin Prodi</option>
              <option value="asesor" {{ old('role', isset($user) ? $user->role : '') == 'asesor' ? 'selected' : '' }}>Asesor</option>
            </select>
            <small class="text-muted">Asesor : User yang memiliki akses untuk melihat data dokumen kuantitatif LED program studi</small>
            <br><small class="text-muted">admin prodi : user yang memiliki akses untuk mengelola data kuantitatif LED program studi</small>
            @error('role')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
          </div>

          <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
              <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan password">
              <div class="input-group-append">
                <button type="button" class="btn btn-secondary" onclick="togglePasswordVisibility()">Lihat</button>
              </div>
            </div>
            @error('password')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
          </div>
          <div class="form-group mb-0">
            <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';">{{ isset($user) ? 'Simpan Perubahan' : 'Tambah akun' }}</button>
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


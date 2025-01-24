@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      <!-- Tempat untuk notifikasi -->
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          <strong><i class="bi bi-check-circle-fill"></i> Berhasil!</strong> {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif
      <!-- Button dan Modal untuk mengunggah dokumen akan ditempatkan di sini jika diperlukan -->
    </div>
  </div>
  <!-- Form untuk mengunggah dokumen baru -->
  <div class="row">
    <div class="col-lg-12 grid-margin stretch-card">
      <form class="card" action="{{ isset($dokumen) ? route('dokumen.update', $dokumen->id) : route('dokumen.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($dokumen))
          @method('PUT')
        @endif
        <div class="card-body">
          <h4 class="card-title">{{ isset($dokumen) ? 'Edit Dokumen' : 'Unggah Dokumen Baru' }}</h4>
          <div class="form-group">
            <label for="">Nama Repository</label>
            <input type="text" class="form-control" value="{{$dokumen->repository->nama_repository}}" disabled>
          </div>
          <div class="form-group">
            <label for="">Kriteria</label>
            <input type="text" class="form-control" value="{{$dokumen->repository->kriteria}}" disabled>
          </div>
          <div class="form-group">
            <label for="dokumen">Dokumen</label>
            <input type="file" class="form-control-file" id="dokumen" name="dokumen">
            @error('dokumen')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="namaDokumen">Nama Dokumen</label>
            <input type="text" class="form-control" id="namaDokumen" name="namaDokumen" placeholder="Masukkan nama dokumen" autofocus value="{{ isset($dokumen) ? $dokumen->nama_dokumen : '' }}">
            @error('namaDokumen')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
          </div>
          <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea class="form-control" id="keterangan" name="keterangan" rows="3">{{ isset($dokumen) ? $dokumen->keterangan : '' }}</textarea>
            @error('keterangan')
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> {{ $message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
            @enderror
          </div>

          <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';">{{ isset($repository) ? 'Simpan Perubahan' : 'Unggah' }}</button>
          <a href="{{route('repository.show',['id' => $dokumen->repository->id])}}" type="button" class="btn btn-secondary">Batal</a>
        </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('js')
<script>
document.addEventListener('DOMContentLoaded', function () {
  const form = document.querySelector('form');
  const submitButton = form.querySelector('button[type="submit"]');
  const originalButtonHtml = submitButton.innerHTML; // Menyimpan teks asli tombol

  form.onsubmit = function() {
    submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Mengunggah...';
    submitButton.disabled = true;
  };

});
</script>
@endsection

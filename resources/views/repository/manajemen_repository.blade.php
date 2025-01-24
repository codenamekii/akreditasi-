@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(auth()->user()->role == 'admin prodi')
      <a href="/repository/form">
        <button class="btn btn-outline-primary mb-2 mb-md-0 mr-2">Buat repository</button>
      </a>
      @endif

    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Repository</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">Repository untuk File Akreditasi Program Studi</p>
        </a>
      </div>
    </div>
  </div>
  <!-- Tambahkan form filter tahun di sini -->
  <div class="row mb-3">
    <div class="col">
      <div class="card">
        <div class="card-body">
          <form action="{{ route('repository.semua') }}" method="GET">
            <div class="form-group">
              <label for="kriteria">Filter Kriteria:</label>
              <select class="form-control" id="kriteria" name="kriteria">
                @for ($i = 1; $i <= 9; $i++)
                <option value="{{ $i }}" {{ request('kriteria') == $i ? 'selected' : '' }}>Kriteria {{ $i }}</option>
                @endfor

              </select>
            </div>
            <button type="submit" class="btn btn-primary">Filter</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Manajemen repository</h5>
          @if(session('success'))
          <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          @if(session('error'))
          <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama Repository</th>
                  <th>Kriteria</th>
                  @if(auth()->user()->role == 'admin prodi')
                  <th>Atur untuk menampilkan repository</th>
                  @endif
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @forelse ($repositories as $repository)
                <tr>
                  <td>
                    @if(strlen($repository->nama_repository) > 20)
                    <div class="text-wrap">{{ $repository->nama_repository }}</div>
                    @else
                    {{ $repository->nama_repository }}
                    @endif
                  </td>
                  <td>Kriteria {{ $repository->kriteria }}</td>
                  @if(auth()->user()->role == 'admin prodi')
                  <td>{{ $repository->view == 'true' ? 'asesor diperbolehkan untuk melihat' : 'hanya khusus admin prodi' }}</td>
                  @endif
                  <td>
                    <a href="/repository/show/{{ $repository->encrypted_id }}" class="btn btn-primary btn-xs" title="Lihat"><i class="fa fa-folder-open"></i></a>
                    @if(auth()->user()->role == 'admin prodi')
                    <a href="{{ route('repository.edit', $repository->id) }}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></a>
                    <a href="{{ route('repository.delete', $repository->id) }}" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
                    <button onclick="navigator.clipboard.writeText('{{ route('repository.show',  $repository->encrypted_id) }}'); alert('Tautan telah disalin ke papan klip.');" class="btn btn-info btn-xs" target="_blank">
                      <i class="fa fa-link"></i>
                    </button>
                    @endif
                  </td>
                </tr>
                @empty
                <tr>
                  <td colspan="4" class="text-center">Tidak ada data repository.</td>
                </tr>
                @endforelse
                <!-- Lebih banyak baris dapat ditambahkan di sini -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- last row starts here -->

</div>
@endsection

@section('css')
<!-- Tambahkan di dalam <head> atau sebelum penutup </body> -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('js')
<!-- Tempatkan skrip JS yang relevan di sini -->
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
  $('.table').DataTable();
});
</script>
@endsection

@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
   <a href="/repository/semua" class="btn btn-outline-primary">Manajemen Repository</a>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Repository</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">Semua file dokumen akreditasi program studi</p>
        </a>
      </div>
    </div>
  </div>
  <!-- first row starts here -->
  <div class="row">
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Semua dokumen</h5>
          @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              {{ session('success') }}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          @endif
          <div class="table-responsive">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Nama File</th>
                  <th>Nama Repository</th>
                  <th>Kriteria</th>
                  <th>Tahun</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </tr>
              </thead>
              <tbody>
                @for ($i = 1; $i <= 20; $i++)
                <tr>
                  <td>File {{ $i }}</td>
                  <td>Repository {{ $i }}</td>
                  <td>Kriteria {{ $i % 5 + 1 }}</td>
                  <td>2023</td>
                  <td>Keterangan untuk Repository {{ $i }}</td>
                  <td>
                    <a href="#" onclick="openPopupDokumen('{{ asset($doc->path) }}')" class="btn btn-primary btn-xs" title="Lihat"><i class="fa fa-eye"></i></a>
                    <button class="btn btn-info btn-xs" title="Lihat Folder"><i class="fa fa-folder-open"></i></button>
                    <button class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-edit"></i></button>
                    <button class="btn btn-danger btn-xs" title="Hapus"><i class="fa fa-trash"></i></button>
                  </td>
                </tr>
                @endfor
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

function openPopupDokumen(url) {
    var width = 500; // Width of the popup window
    var height = 600; // Height of the popup window
    var leftPosition = (screen.width - width) / 2;
    var topPosition = (screen.height - height) / 2;
    var popupOptions = 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=' + width + ', height=' + height + ', top=' + topPosition + ', left=' + leftPosition;

    window.open(url, 'Popup', popupOptions);
}
</script>
@endsection

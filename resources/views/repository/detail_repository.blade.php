@extends('template')

@section('content-wrapper')
<div class="content-wrapper pb-0">
  <div class="page-header flex-wrap">
    <div class="header-left">
      @if(auth()->user()->role != 'asesor')
      <a href="{{route('repository.semua')}}" class="btn btn-outline-primary mb-2 mb-md-0 mr-2">Kelola Repository</a>
      @endif

      <!-- Modal untuk upload dokumen -->
      <div class="modal fade" id="uploadModal" tabindex="-1" role="dialog" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="uploadModalLabel">Upload Dokumen</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form method="POST" action="{{ route('dokumen.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="repository_id" value="{{ $repository->id }}">
                <div class="form-group">
                  <label for="document">Pilih Dokumen (hanya file PDF)</label>
                  <input type="file" class="form-control-file @error('document') is-invalid @enderror" id="document" name="document" accept=".pdf">
                  @error('document')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="documentName">Nama Dokumen</label>
                  <input type="text" class="form-control @error('documentName') is-invalid @enderror" id="documentName" name="documentName">
                  @error('documentName')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="form-group">
                  <label for="description">Deskripsi Dokumen</label>
                  <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3"></textarea>
                  @error('description')
                    <div class="invalid-feedback">{{ $message }}</div>
                  @enderror
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                  <button type="submit" class="btn btn-primary" onclick="this.disabled=true;this.form.submit();this.innerText='Loading...';">Upload</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="header-right d-flex flex-wrap mt-2 mt-sm-0">
      <div class="d-flex align-items-center">
        <a href="#">
          <p class="m-0 pr-3">Kelola Repository</p>
        </a>
        <a class="pl-3 mr-4" href="#">
          <p class="m-0">{{ Str::limit($repository->nama_repository, 50) }}</p>
        </a>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-12 grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Informasi Repository <!-- Tombol untuk menyalin URL -->
           @if(auth()->user()->role != 'asesor')
          <button onclick="copyToClipboard()" class="btn btn-info"><i class="fa fa-link"></i></button>
          @endif
          </h4>
          <div id="copyAlert" class="alert alert-success mt-2" style="display:none;">
            URL disalin.
          </div>
          <div class="row">
            <div class="col">
              <div class="form-group">
                <label>Nama Repository</label>
                <p class="form-control">{{ $repository->nama_repository }}</p>
              </div>
            </div>
            <div class="col">
              <div class="form-group">
                <label>Kriteria</label>
                <p class="form-control">Kriteria {{ $repository->kriteria }}</p>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>
    <div class="col grid-margin stretch-card">
      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Dokumen Repository
           @if(auth()->user()->role != 'asesor')
          <button class="btn btn-outline-primary btn-sm mb-2 mb-md-0 mr-2" data-toggle="modal" data-target="#uploadModal">Upload Dokumen</button>
          @endif
        </h5>
          @if(session('success'))
            <div class="alert alert-success" role="alert">
              {{ session('success') }}
            </div>
          @endif
          @if($dokumen->isEmpty())
            <div class="alert alert-info" role="alert">
              Tidak ada dokumen yang terkait dengan repository ini.
            </div>
          @else
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Nama Dokumen</th>
                    <th>Keterangan</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($dokumen as $doc)
                  <tr>
                    <td>{{ $doc->nama_dokumen }}</td>
                    <td>{{ $doc->keterangan }}</td>
                    <td>
                      <a href="#" onclick="openPopupDokumen('{{ asset($doc->path) }}')" class="btn btn-primary btn-xs" title="Melihat Dokumen"><i class="fa fa-eye"></i></a>
                       @if(auth()->user()->role != 'asesor')
                      <button class="btn btn-warning btn-xs" title="Edit" onclick="window.location.href='{{route('dokumen.edit', $doc->id)}}'"><i class="fa fa-edit"></i></button>
                      <a href="{{ route('dokumen.delete', $doc->id) }}" class="btn btn-danger btn-xs" title="Hapus" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i class="fa fa-trash"></i></a>
                      <button onclick="navigator.clipboard.writeText('{{ asset($doc->path) }}'); alert('Tautan telah disalin ke papan klip.');" class="btn btn-info btn-xs" target="_blank"><i class="fa fa-link"></i></button>
                      @endif
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('css')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
@endsection

@section('js')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function() {
    $('.table').DataTable();
});

function copyToClipboard() {
  const el = document.createElement('textarea');
  el.value = window.location.href;
  document.body.appendChild(el);
  el.select();
  document.execCommand('copy');
  document.body.removeChild(el);
  $('#copyAlert').show().delay(2000).fadeOut();
}

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
